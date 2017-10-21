<?php

require 'vendor/autoload.php';

$queryBus = new \Prooph\ServiceBus\QueryBus();

$router = new \Prooph\ServiceBus\Plugin\Router\QueryRouter();
$router->route(\Acme\AddQuery::class)
    ->to(\Acme\AddQueryHandler::class);

$router->attachToMessageBus($queryBus);

$container = new class implements \Psr\Container\ContainerInterface {
    public function get($id)
    {
        switch ($id) {
            case \Acme\AddQueryHandler::class:
                return new \Acme\AddQueryHandler();
                break;
        }
    }

    public function has($id)
    {
        return true;
    }
};

$serviceLocatorPlugin = new \Prooph\ServiceBus\Plugin\ServiceLocatorPlugin($container);
$serviceLocatorPlugin->attachToMessageBus($queryBus);

$promise = $queryBus->dispatch(new \Acme\AddQuery(['first' => 15, 'second' => 6]));

$promise->then(function ($result) {
    var_dump($result);
}, function ($result) {
    echo $result;
});
