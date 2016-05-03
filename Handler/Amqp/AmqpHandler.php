<?php

namespace WP\RemoteEventDispatcher\Handler\Amqp;

use AMQPExchange;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Message\AMQPMessage;
use WP\RemoteEventDispatcher\Handler\HandlerInterface;
use WP\RemoteEventDispatcher\Model\AbstractEvent;

/**
 * Class AmqpHandler
 * @package WP\RemoteEventDispatcher\Handler
 */
class AmqpHandler implements HandlerInterface
{
    /**
     * @var AMQPExchange|AMQPChannel $exchange
     */
    private $exchange;

    /**
     * @var string
     */
    protected $exchangeName;

    /**
     * @param AMQPExchange|AMQPChannel $exchange AMQPExchange (php AMQP ext) or PHP AMQP lib channel, ready for use
     * @param string $exchangeName
     */
    public function __construct($exchange, $exchangeName = 'remote_event_dispatcher')
    {
        if ($exchange instanceof AMQPExchange) {
            $exchange->setName($exchangeName);
        } elseif ($exchange instanceof AMQPChannel) {
            $this->exchangeName = $exchangeName;
        } else {
            throw new \InvalidArgumentException('PhpAmqpLib\Channel\AMQPChannel or AMQPExchange instance required');
        }

        $this->exchange = $exchange;
    }

    /**
     * Handles the given Event
     *
     * @param AbstractEvent $event
     * @return AbstractEvent
     */
    public function produce(AbstractEvent $event)
    {
        $message = new AMQPMessage(serialize($event));
        $this->exchange->basic_publish($message, '', $this->exchangeName);
    }

    /**
     * @param callable $callback
     * @return void
     */
    public function consume(callable $callback)
    {
        $internCallback = function ($msg) use ($callback) {
            //echo " [x] Received ", $msg->body, "\n";
            $callback(unserialize($msg->body));
        };

        $this->exchange->basic_consume($this->exchangeName, '', false, true, false, false, $internCallback);

        while (count($this->exchange->callbacks)) {
            $this->exchange->wait();
        }
    }
}