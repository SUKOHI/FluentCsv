<?php

namespace Sukohi\FluentCsv\Facades;

use Illuminate\Support\Facades\Facade;

class FluentCsv extends Facade {

    /**
    * Get the registered name of the component.
    *
    * @return string
    */
    protected static function getFacadeAccessor() { return 'fluent-csv'; }

}
