<?php



namespace Custom;

use Custom\Users\Providers\UserFileServiceProvider;


use Illuminate\Support\ServiceProvider;

class ConfigProvider extends ServiceProvider

{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(UserFileServiceProvider::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
