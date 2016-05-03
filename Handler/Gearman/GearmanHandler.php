<?php

namespace WP\RemoteEventDispatcher\Handler\Gearman;

use WP\RemoteEventDispatcher\Handler\HandlerInterface;
use WP\RemoteEventDispatcher\Model\AbstractEvent;

/**
 * Class GearmanHandler
 * @package WP\RemoteEventDispatcher\Handler\Gearman
 */
class GearmanHandler implements HandlerInterface
{
    /**
     * Handles the given Event
     *
     * @param AbstractEvent $event
     * @return AbstractEvent
     */
    public function produce(AbstractEvent $event)
    {
        // TODO: Implement produce() method.
    }

    /**
     * @param callable $callback
     * @return void
     */
    public function consume(callable $callback)
    {
        // TODO: Implement consume() method.
    }
}