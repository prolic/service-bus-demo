<?php

namespace Acme;

class TestCommandHandler
{
    public function __invoke(TestCommand $command)
    {
        var_dump($command->payload());
    }
}
