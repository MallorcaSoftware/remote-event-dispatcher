<?php

namespace WP\RemoteEventDispatcher\Handler;

use WP\RemoteEventDispatcher\Model\AbstractEvent;

/**
 * Interface HandlerInterface
 * @package WP\RemoteEventDispatcher\EventDispatcher
 */
interface HandlerInterface
{
    /**
     * Handles the given Event
     *
     * @param AbstractEvent $event
     * @return AbstractEvent
     */
    public function produce(AbstractEvent $event);

    /**
     * @param callable $callback
     * @return void
     */
    public function consume(callable $callback);
}