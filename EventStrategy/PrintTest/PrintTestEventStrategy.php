<?php

namespace WP\RemoteEventDispatcher\EventStrategy\PrintTest;

use WP\RemoteEventDispatcher\EventStrategy\EventStrategyInterface;
use WP\RemoteEventDispatcher\Model\AbstractEvent;

/**
 * Class PrintTestEventStrategy
 * @package WP\RemoteEventDispatcher\EventStrategy\Registry
 */
class PrintTestEventStrategy implements EventStrategyInterface
{
    /**
     * @var string
     */
    private $messageToPrint;

    /**
     * PrintTestEventStrategy constructor.
     * @param string $messageToPrint
     */
    public function __construct($messageToPrint)
    {
        $this->messageToPrint = $messageToPrint;
    }

    /**
     * @throws \RuntimeException if something goes wrong
     * @param AbstractEvent $event
     * @return void
     */
    public function execute(AbstractEvent $event)
    {
        echo $this->messageToPrint;
    }
}