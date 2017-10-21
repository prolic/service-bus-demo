<?php

namespace Acme;

use Prooph\Common\Messaging\PayloadTrait;
use Prooph\Common\Messaging\Query;

class AddQuery extends Query
{
    use PayloadTrait;

    public function first()
    {
        return $this->payload()['first'];
    }

    public function second()
    {
        return $this->payload()['second'];
    }
}
