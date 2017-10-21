<?php

require 'vendor/autoload.php';

$eventBus = new \Prooph\ServiceBus\EventBus();

$router = new \Prooph\ServiceBus\Plugin\Router\EventRouter();
$router
    ->route(\Acme\SomethingHappended::class)
    ->to(\Acme\SomethingHappendedHandler2::class)
    ->andTo(function (\Acme\SomethingHappended $event) {
        echo $event->messageName() . ' called, too';
    });

$router->attachToMessageBus($eventBus);

$container = new class implements \Psr\Container\ContainerInterface {
    public function get($id)
    {
        switch ($id) {
            case \Acme\SomethingHappendedHandler2::class:
                return new \Acme\SomethingHappendedHandler2();
                break;
        }
    }

    public function has($id)
    {
        return true;
    }
};

$onEventHandlerStrategy = new \Prooph\ServiceBus\Plugin\InvokeStrategy\OnEventStrategy();
$onEventHandlerStrategy->attachToMessageBus($eventBus);

$serviceLocatorPlugin = new \Prooph\ServiceBus\Plugin\ServiceLocatorPlugin($container);
$serviceLocatorPlugin->attachToMessageBus($eventBus);

$eventBus->dispatch(new \Acme\SomethingHappended(['1' => '2']));
