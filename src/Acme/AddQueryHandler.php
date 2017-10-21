<?php

namespace Acme;

use React\Promise\Deferred;

class AddQueryHandler
{
    public function __invoke(AddQuery $query, Deferred $deferred)
    {
        //$deferred->resolve($query->first() + $query->second());
        $deferred->reject('damn it');
    }
}
