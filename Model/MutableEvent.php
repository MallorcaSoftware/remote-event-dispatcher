<?php

namespace WP\RemoteEventDispatcher\Model;

/**
 * Class MutableEvent
 * @package WP\RemoteEventDispatcher\Model
 */
class MutableEvent extends AbstractEvent
{

    /**
     * @var string
     */
    private $name;

    /**
     * MutableEvent constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Returns the name of the Event
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}