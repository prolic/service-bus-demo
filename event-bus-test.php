<?php

require 'vendor/autoload.php';

$eventBus = new \Prooph\ServiceBus\EventBus();

$router = new \Prooph\ServiceBus\Plugin\Router\EventRouter();
$router
    ->route('somethingHappened')
    ->to(function ($event) {
        var_dump($event);
    })
    ->andTo(function ($event) {
        echo $event . ' called, too';
    });

$router->attachToMessageBus($eventBus);

$eventBus->dispatch('somethingHappened');
