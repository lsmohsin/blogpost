<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\UploadFile;
use App\Facades\UploadFileFacade;
class UploadFileServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('uploadfile', function () {
            return new UploadFile();
        });
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
