<?php

namespace Acme;

use Prooph\Common\Messaging\Command;
use Prooph\Common\Messaging\PayloadTrait;

class TestCommand extends Command
{
    protected $messageName = 'test';

    use PayloadTrait;
}
