<?php

namespace Acme;

class SomethingHappendedHandler
{
    public function __invoke(SomethingHappended $event)
    {
        var_dump($event->payload());
    }
}
