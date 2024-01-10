<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class UploadFileFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'uploadfile';
    }
}
