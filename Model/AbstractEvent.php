<?php

namespace WP\RemoteEventDispatcher\Model;

/**
 * Class AbstractEvent
 * @package WP\RemoteEventDispatcher\Model
 */
abstract class AbstractEvent
{
    /**
     * Returns the name of the Event
     * @return string
     */
    abstract public function getName();
}