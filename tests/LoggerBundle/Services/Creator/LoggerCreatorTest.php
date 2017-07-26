<?php
/**
 * Created by PhpStorm.
 * User: serjio
 * Date: 25.07.17
 * Time: 11:16
 */

namespace Tests\LoggerBundle\Services\Creator;


use LoggerBundle\Entity\Logger;
use LoggerBundle\Persistent\LoggerRepository;
use LoggerBundle\Services\Creator\LoggerCreator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

class LoggerCreatorTest extends TestCase
{
    /**
     * @var LoggerRepository|\PHPUnit_Framework_MockObject_MockObject
     */
    private $loggerRepository;

    /**
     * @var Request|\PHPUnit_Framework_MockObject_MockObject
     */
    private $request;

    /**
     * @var LoggerCreator
     */
    private $loggerCreator;

    public function setUp()
    {
        $this->loggerRepository = $this->createMock(LoggerRepository::class);
        $this->request = $this->createMock(Request::class);

        $this->loggerCreator = new LoggerCreator($this->loggerRepository);
    }

    public function testCreate()
    {
        $ip = '127.0.0.1';
        $method = 'POST';
        $content = 'content';
        $headers = 'headers';
        $route = 'test_route';

        $logger = new Logger();
        $logger->setIp($ip);
        $logger->setMethod($method);
        $logger->setRoute($route);
        $logger->setHeader($headers);
        $logger->setBody($content);

        $this->request->attributes = new ParameterBag(['_route' => $route]);
        $this->request->headers = $headers;
        $this->request->expects($this->once())
            ->method('getClientIp')
            ->willReturn($ip);
        $this->request->expects($this->once())
            ->method('getMethod')
            ->willReturn($method);
        $this->request->expects($this->once())
            ->method('getContent')
            ->willReturn($content);

        $this->loggerRepository->expects($this->once())
            ->method('save')
            ->with($logger);

       $this->loggerCreator->create($this->request);
    }
}