<?php namespace Wedocreatives\Toggl\Facades;


use Illuminate\Support\Facades\Facade;

class Toggl extends Facade {

    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Toggl';
    }

}