<?php

namespace Ahmeti\DBOption\Facades;

use Illuminate\Support\Facades\Facade;

class DBOption extends Facade {
    protected static function getFacadeAccessor() { return 'ahmeti-db-option'; }
}