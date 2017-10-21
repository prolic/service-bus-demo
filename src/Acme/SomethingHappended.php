<?php

namespace Acme;

use Prooph\Common\Messaging\DomainEvent;
use Prooph\Common\Messaging\PayloadTrait;

class SomethingHappended extends DomainEvent
{
    use PayloadTrait;
}