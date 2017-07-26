<?php
/**
 * Created by PhpStorm.
 * User: serjio
 * Date: 25.07.17
 * Time: 1:05
 */

namespace LoggerBundle\Services\Subscribe;


use LoggerBundle\Services\Creator\LoggerCreator;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class LoggerApiRequestSubscriber implements EventSubscriberInterface
{
    /**
     * @var LoggerCreator
     */
    private $loggerCreator;

    /**
     * LoggerApiSubscriber constructor.
     *
     * @param LoggerCreator $loggerCreator
     */
    public function __construct(LoggerCreator $loggerCreator)
    {
        $this->loggerCreator = $loggerCreator;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => [
                ['onKernelRequest'],
            ],
        ];
    }

    /**
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        if ($this->isCreateLogger($request->getPathInfo())) {
            $this->loggerCreator->create($request);
        }
    }

    /**
     * @param string $pathInfo
     *
     * @return bool
     */
    private function isCreateLogger(string $pathInfo) :bool
    {
        return preg_match('/^\/api\//', $pathInfo);
    }
}