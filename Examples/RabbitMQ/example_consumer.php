<?php

require_once '../../vendor/autoload.php';

// Configuration for RabbitMQ or any other queue which is based on AMQP protocol
$queueName = 'remote_event_dispatcher';
$config = [
    'host' => 'localhost',
];
$connection = new \PhpAmqpLib\Connection\AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

// Configure AmqpHandler
$handler = new \WP\RemoteEventDispatcher\Handler\Amqp\AmqpHandler($channel, $queueName);

// Setup EventStrategyRegistry
$eventStrategyRegistry = new \WP\RemoteEventDispatcher\EventStrategy\Registry\EventStrategyRegistry();
$eventStrategyRegistry->setEventStrategy('printHalloEvent', new \WP\RemoteEventDispatcher\EventStrategy\PrintTest\PrintTestEventStrategy('Hallo'));
$eventStrategyRegistry->setEventStrategy('printTestEvent', new \WP\RemoteEventDispatcher\EventStrategy\PrintTest\PrintTestEventStrategy('Test'));

// Setup RemoteEventListener with AmqpHandler
$remoteEventListener = new \WP\RemoteEventDispatcher\EventListener\RemoteEventListener($handler, $eventStrategyRegistry);
$remoteEventListener->listen();