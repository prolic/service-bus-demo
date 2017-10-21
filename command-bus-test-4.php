<?php

require 'vendor/autoload.php';

$commandBus = new \Prooph\ServiceBus\CommandBus();

$router = new \Prooph\ServiceBus\Plugin\Router\CommandRouter();
$router->route('test')->to(\Acme\TestCommandHandler2::class);

$router->attachToMessageBus($commandBus);

$container = new class implements \Psr\Container\ContainerInterface {
    public function get($id)
    {
        switch ($id) {
            case \Acme\TestCommandHandler2::class:
                return new \Acme\TestCommandHandler2();
            break;
        }
    }

    public function has($id)
    {
        return true;
    }
};

$serviceLocatorPlugin = new \Prooph\ServiceBus\Plugin\ServiceLocatorPlugin($container);
$serviceLocatorPlugin->attachToMessageBus($commandBus);

$handleCommandStrategy = new \Prooph\ServiceBus\Plugin\InvokeStrategy\HandleCommandStrategy();
$handleCommandStrategy->attachToMessageBus($commandBus);

$commandBus->dispatch(new \Acme\TestCommand(['foo' => 'bar']));
