<?php

declare(strict_types=1);

namespace App\EventSubscriber\Exception;

use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

abstract class ExceptionFormatter implements EventSubscriberInterface
{
    public function __construct(
        protected LoggerInterface $logger,
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [KernelEvents::EXCEPTION => 'onKernelException'];
    }

    abstract public function onKernelException(ExceptionEvent $event): void;
}
