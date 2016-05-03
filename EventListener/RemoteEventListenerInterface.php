<?php

namespace WP\RemoteEventDispatcher\EventListener;

/**
 * Interface RemoteEventListenerInterface
 * @package WP\RemoteEventDispatcher\EventListener
 */
interface RemoteEventListenerInterface
{
    /**
     * Starts listening for events
     * @return void
     */
    public function listen();
}