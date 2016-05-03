<?php

namespace WP\RemoteEventDispatcher\EventDispatcher;

use WP\RemoteEventDispatcher\Handler\HandlerInterface;
use WP\RemoteEventDispatcher\Model\AbstractEvent;

/**
 * Defines the RemoteEventDispatcher
 * @package WP\RemoteEventDispatcher\EventDispatcher
 */
interface RemoteEventDispatcherInterface
{
    /**
     * Dispatches an event to all registered handlers.
     *
     * @param AbstractEvent $event The event to pass to the event handlers/listeners.
     *                          If not supplied, an empty Event instance is created.
     *
     * @return AbstractEvent
     */
    public function dispatch(AbstractEvent $event);

    /**
     * @return HandlerInterface
     */
    public function getHandler();

    /**
     * @param HandlerInterface $handler
     * @return void
     */
    public function setHandler(HandlerInterface $handler);
}