<?php

namespace package\Http\Controllers;

use App\Facades\UploadFileFacade;
use App\Http\Controllers\Controller;
use App\Services\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use League\Csv\Writer;
use App\Http\Resources\PostCollection;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\StorePostRequest;
use App\Events\PostViewed;
use Illuminate\Support\Facades\Route;


class UserController extends Controller
{

 public function index(){
     return view('package::index');
 }
}
