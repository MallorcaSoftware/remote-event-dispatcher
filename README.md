# Remote Event Dispatcher

RemoteEventDispatcher for communicating between multiple systems.

## Handler
Transport for Events.
Possible Handlers:
- AmqpHandler (Handler to send Events via a queue which is implementing the Amqp protocol)

## Dispatch Events
To dispatch events you have to configure the RemoteEventDispatcher. The RemoteEventDispatcher requires a handler.

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

## Example

Implementation example is available under Example\RabbitMQ\*