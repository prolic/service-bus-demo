<?php

namespace Acme;

class TestCommandHandler2
{
    public function handle(TestCommand $command)
    {
        var_dump($command->payload());
    }
}
