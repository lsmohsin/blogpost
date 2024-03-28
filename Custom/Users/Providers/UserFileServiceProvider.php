<?php



namespace Custom\Users\Providers;

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
      $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->namespace = 'package\Http\Controllers';


    }
}
