<?php

require 'vendor/autoload.php';

$commandBus = new \Prooph\ServiceBus\CommandBus();

$router = new \Prooph\ServiceBus\Plugin\Router\CommandRouter();
$router->route('test')->to(function ($message) {
    var_dump($message);
});

$router->attachToMessageBus($commandBus);

$commandBus->dispatch('test');
