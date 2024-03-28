<?php



namespace package\Providers;

use Illuminate\Support\ServiceProvider;

class UserFileServiceProvider extends ServiceProvider

{
    protected $namespace;
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
//        $this->app->register(\package\Providers\UserFileServiceProvider::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
       $this->loadRoutesFrom(__DIR__.'/../routes/user.php');
       $this->loadViewsFrom(__DIR__.'/../resources/views', 'package');

        $this->namespace = 'package\Http\Controllers';

    }
}
