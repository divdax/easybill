<?php

namespace DivDax\Easybill\Facade;

use Illuminate\Support\Facades\Facade;

class Easybill extends Facade
{
    protected static function getFacadeAccessor() {
        return 'easybill';
    }
}
