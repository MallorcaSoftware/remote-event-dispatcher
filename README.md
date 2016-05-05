# Remote Event Dispatcher

[![Build Status](https://travis-ci.org/wildpascal/remote-event-dispatcher.svg?branch=master)](https://travis-ci.org/wildpascal/remote-event-dispatcher) [![Total Downloads](https://poser.pugx.org/wildpascal/remote-event-dispatcher/downloads.svg)](https://packagist.org/packages/wildpascal/remote-event-dispatcher) [![Latest Stable Version](https://poser.pugx.org/wildpascal/remote-event-dispatcher/v/stable.svg)](https://packagist.org/packages/wildpascal/remote-event-dispatcher)

RemoteEventDispatcher for communicating between multiple systems.

## Installation ##

Require the bundle and its dependencies with composer:

```bash
$ composer require wildpascal/remote-event-dispatcher
```

## Handler
Transport for Events.
Possible Handlers:
- AmqpHandler (Handler to send Events via a queue which is implementing the Amqp protocol)

## Dispatch Events
To dispatch events you have to configure the RemoteEventDispatcher. The RemoteEventDispatcher requires a Handler.

You can dispatch every event which extends the AbstractEvent.

```php
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
```

## Listen for Events
To Listen for Events you have to configure the RemoteEventListener. The RemoteEventListener requires a Handler and a EventStrategy.

You also can use a EventStrategyRegistry to register different EventStrategies based on the eventName to implement a logic based on Events

```php
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
```

## Example

Implementation example is available under Example\RabbitMQ\*