<?php namespace Wedocreatives\Toggl;


use Illuminate\Support\ServiceProvider;

use Config;

class TogglServiceProvider extends ServiceProvider {

    /**
     * @var bool
     */
    protected $defer = false;


    /**
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Toggl', function () {
                return new TogglService( Config::get( 'services.toggl.workspace' ), Config::get( 'services.toggl.token' ) );
            }
        );
    }

    /**
     * @return array
     */
    public function provides()
    {
        return array('Toggl');
    }

}