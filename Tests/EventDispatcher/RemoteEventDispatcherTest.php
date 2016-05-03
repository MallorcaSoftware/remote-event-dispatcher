<?php

namespace WP\RemoteEventDispatcher\Tests\EventDispatcher;

use WP\RemoteEventDispatcher\EventDispatcher\RemoteEventDispatcher;
use WP\RemoteEventDispatcher\Handler\HandlerInterface;
use WP\RemoteEventDispatcher\Model\AbstractEvent;

/**
 * Class RemoteEventDispatcherTest
 * @package WP\RemoteEventDispatcher\Tests\EventDispatcher
 */
class RemoteEventDispatcherTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldDelegateDispatchToHandler()
    {
        $event = $this->buildEvent();
        $handler = $this->buildHandler();
        $remoteEventDispatcher = new RemoteEventDispatcher($handler);

        $handler->expects($this->once())
            ->method('handle')
            ->with($event)
            ->willReturn($event);

        $dispatchedEvent = $remoteEventDispatcher->dispatch($event);

        $this->assertSame($event, $dispatchedEvent);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|HandlerInterface
     */
    private function buildHandler()
    {
        return $this->getMockForAbstractClass(HandlerInterface::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|AbstractEvent
     */
    private function buildEvent()
    {
        return $this->getMockForAbstractClass(AbstractEvent::class);
    }
}