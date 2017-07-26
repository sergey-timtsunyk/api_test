<?php

namespace LoggerBundle;

use LoggerBundle\DependencyInjection\LoggerBundleExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class LoggerBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new LoggerBundleExtension();
    }
}
