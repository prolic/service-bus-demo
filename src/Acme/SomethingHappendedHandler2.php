<?php

namespace Acme;

class SomethingHappendedHandler2
{
    public function onEvent(SomethingHappended $event)
    {
        var_dump($event->payload());
    }
}
