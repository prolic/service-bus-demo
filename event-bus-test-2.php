<?php

require 'vendor/autoload.php';

$eventBus = new \Prooph\ServiceBus\EventBus();

$router = new \Prooph\ServiceBus\Plugin\Router\EventRouter();
$router
    ->route(\Acme\SomethingHappended::class)
    ->to(function (\Acme\SomethingHappended $event) {
        var_dump($event->payload());
    })
    ->andTo(function (\Acme\SomethingHappended $event) {
        echo $event->messageName() . ' called, too';
    });

$router->attachToMessageBus($eventBus);

$eventBus->dispatch(new \Acme\SomethingHappended(['1' => '2']));
