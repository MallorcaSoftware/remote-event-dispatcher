<?php

namespace WP\RemoteEventDispatcher\EventStrategy\Registry;

use WP\RemoteEventDispatcher\EventStrategy\EventStrategyInterface;
use WP\RemoteEventDispatcher\Model\AbstractEvent;

/**
 * Class EventStrategyRegistry
 * @package WP\RemoteEventDispatcher\EventStrategy\Registry
 */
class EventStrategyRegistry implements EventStrategyInterface
{
    /**
     * @var EventStrategyInterface[]
     */
    private $eventStrategies = [];

    /**
     * @throws \RuntimeException if something goes wrong
     * @param AbstractEvent $event
     * @return void
     */
    public function execute(AbstractEvent $event)
    {
        try {
            $this->getEventStrategy($event->getName())->execute($event);
        } catch (\InvalidArgumentException $e) {
            throw new \RuntimeException('Something goes wrong', 0, $e);
        }
    }

    /**
     * @throws \InvalidArgumentException if already an entry exists for given $eventName
     * @param string $eventName
     * @param EventStrategyInterface $eventStrategy
     *
     * @return void
     */
    public function setEventStrategy($eventName, EventStrategyInterface $eventStrategy)
    {
        if (isset($this->eventStrategies[$eventName])) {
            throw new \InvalidArgumentException('There is already an entry');
        }

        $this->eventStrategies[$eventName] = $eventStrategy;
    }

    /**
     * @throws \InvalidArgumentException if there is no entry for given $eventName
     * @param string $eventName
     * @return EventStrategyInterface
     */
    public function getEventStrategy($eventName)
    {
        if (!isset($this->eventStrategies[$eventName])) {
            throw new \InvalidArgumentException('There is no entry!');
        }

        return $this->eventStrategies[$eventName];
    }
}