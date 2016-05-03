<?php

namespace WP\RemoteEventDispatcher\EventListener;

use WP\RemoteEventDispatcher\EventStrategy\EventStrategyInterface;
use WP\RemoteEventDispatcher\Handler\HandlerInterface;
use WP\RemoteEventDispatcher\Model\AbstractEvent;

/**
 * Class RemoteEventListener
 * @package WP\RemoteEventDispatcher\EventListener
 */
class RemoteEventListener implements RemoteEventListenerInterface
{
    /**
     * @var HandlerInterface
     */
    private $handler;

    /**
     * @var EventStrategyInterface
     */
    private $eventStrategy;

    /**
     * RemoteEventListener constructor.
     * @param HandlerInterface $handler
     * @param EventStrategyInterface $eventStrategy
     */
    public function __construct(HandlerInterface $handler, EventStrategyInterface $eventStrategy)
    {
        $this->handler = $handler;
        $this->eventStrategy = $eventStrategy;
    }

    /**
     * Starts listening for events
     * @return void
     */
    public function listen()
    {
        $callback = function (AbstractEvent $event) {
            $this->onEvent($event);
        };
        $this->handler->consume($callback);
    }

    /**
     * @param AbstractEvent $event
     * @return void
     */
    private function onEvent(AbstractEvent $event)
    {
        try {
            $this->eventStrategy->execute($event);
        } catch (\RuntimeException $e) {
            print 'something goes wrong';
        }
    }
}