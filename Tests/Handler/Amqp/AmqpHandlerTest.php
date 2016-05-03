<?php

namespace WP\RemoteEventDispatcher\Tests\Handler\Amqp;

use AMQPExchange;
use WP\RemoteEventDispatcher\Handler\Amqp\AmqpHandler;
use WP\RemoteEventDispatcher\Model\AbstractEvent;

/**
 * Class AmqpHandlerTest
 * @package WP\RemoteEventDispatcher\Tests\Handler\Amqp
 */
class AmqpHandlerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage PhpAmqpLib\Channel\AMQPChannel or AMQPExchange instance required
     */
    public function shouldThrowAnExceptionIfExchangeIsNotValid()
    {
        new AmqpHandler(null, 'testChannel');
    }

    /**
     * @test
     */
    public function shouldPublishAmqpMessage()
    {
        $exchange = $this->buildAMQPExchange();
        $exchange->expects($this->once())
            ->method('setName')
            ->with('testChannel');
        $amqpHandler = new AmqpHandler($exchange, 'testChannel');

        //$amqpHandler->handle($this->buildEvent());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|AMQPExchange
     */
    private function buildAMQPExchange()
    {
        return $this->getMockBuilder(AMQPExchange::class)->disableOriginalConstructor()->getMock();
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|AbstractEvent
     */
    private function buildEvent()
    {
        return $this->getMockForAbstractClass(AbstractEvent::class);
    }
}