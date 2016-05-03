<?php

namespace WP\RemoteEventDispatcher\EventStrategy;

use WP\RemoteEventDispatcher\Model\AbstractEvent;

/**
 * Interface EventStrategyInterface
 * @package WP\RemoteEventDispatcher\EventListener
 */
interface EventStrategyInterface
{
    /**
     * @throws \RuntimeException if something goes wrong
     * @param AbstractEvent $event
     * @return void
     */
    public function execute(AbstractEvent $event);
}