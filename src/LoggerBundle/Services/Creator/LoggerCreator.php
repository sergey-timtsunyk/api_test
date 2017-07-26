<?php
/**
 * Created by PhpStorm.
 * User: serjio
 * Date: 25.07.17
 * Time: 1:13
 */

namespace LoggerBundle\Services\Creator;

use LoggerBundle\Entity\Logger;
use Symfony\Component\HttpFoundation\Request;;
use LoggerBundle\Persistent\LoggerRepository;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class LoggerCreator
{
    /**
     * @var LoggerRepository
     */
    private $loggerRepository;

    /**
     * LoggerCreator constructor.
     *
     * @param LoggerRepository $loggerRepository
     */
    public function __construct( LoggerRepository $loggerRepository)
    {
        $this->loggerRepository = $loggerRepository;
    }

    /**
     * @param Request $request
     */
    public function create($request)
    {
        $logger = $this->transformRequestToLogger($request);
        $this->loggerRepository->save($logger);
    }

    /**
     * @param Request $request
     *
     * @return Logger
     */
    private function transformRequestToLogger(Request $request) : Logger
    {
        $logger = new Logger();

        return $logger
            ->setIp($request->getClientIp())
            ->setMethod($request->getMethod())
            ->setRoute($request->attributes->get('_route'))
            ->setHeader($request->headers)
            ->setBody($request->getContent());
    }
}