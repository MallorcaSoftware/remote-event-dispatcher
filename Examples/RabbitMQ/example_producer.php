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

// Setup RemoteEventDispatcher with AmqpHandler
$remoteEventDispatcher = new \WP\RemoteEventDispatcher\EventDispatcher\RemoteEventDispatcher($handler);

$printHalloEvent = new \WP\RemoteEventDispatcher\Model\MutableEvent('printHalloEvent');
$printTestEvent = new \WP\RemoteEventDispatcher\Model\MutableEvent('printTestEvent');

$remoteEventDispatcher->dispatch($printHalloEvent);
$remoteEventDispatcher->dispatch($printTestEvent);