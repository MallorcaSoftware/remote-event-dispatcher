<?php

namespace WP\RemoteEventDispatcher\EventDispatcher;

use WP\RemoteEventDispatcher\Handler\HandlerInterface;
use WP\RemoteEventDispatcher\Model\AbstractEvent;

/**
 * Class RemoteEventDispatcher
 * @package WP\RemoteEventDispatcher\EventDispatcher
 */
class RemoteEventDispatcher implements RemoteEventDispatcherInterface
{
    /**
     * @var HandlerInterface
     */
    private $handler;

    /**
     * RemoteEventDispatcher constructor.
     * @param HandlerInterface $handler
     */
    public function __construct(HandlerInterface $handler)
    {
        $this->handler = $handler;
    }

    /**
     * Dispatches an event to all registered handlers.
     *
     * @param AbstractEvent $event The event to pass to the event handlers/listeners.
     *                          If not supplied, an empty Event instance is created.
     *
     * @return AbstractEvent
     */
    public function dispatch(AbstractEvent $event)
    {
        return $this->handler->produce($event);
    }

    /**
     * @return HandlerInterface
     */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
     * @param HandlerInterface $handler
     * @return void
     */
    public function setHandler(HandlerInterface $handler)
    {
        $this->handler = $handler;
    }
}