<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ApiPostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('signup', [ApiController::class, 'signup']);
Route::post('login', [ApiController::class, 'login']);
//Route::middleware('jwt.verify')->group(function () {
//
//});




Route::group([

    'middleware' => 'auth:api',
//    'namespace' => 'App\Http\Controllers',
//    'prefix' => 'auth'

], function ($router) {
    Route::post('posts', [ApiPostController::class, 'store']);
    Route::get('/tags', [ApiPostController::class, 'index']);
    Route::get('/allposts', [ApiPostController::class, 'allposts']);
    Route::delete('/posts/{id}', [ApiPostController::class, 'delete']);
   
    Route::post('/bulk-delete', [ApiPostController::class, 'bulkDelete']);
    Route::get('/detail-posts/{postId}', [ApiPostController::class, 'showPostDetails']);
    Route::get('/edit-post/{postId}', [ApiPostController::class, 'edit'])->name('post.edit');

    Route::put('/update-post/{postId}', [ApiPostController::class, 'update']);
    Route::get('/posts/search/{searchpost}', [ApiPostController::class, 'search']);
//    Route::post('login', 'AuthController@login');
       Route::post('/posts/{postId}/comments', [ApiPostController::class, 'storeComment']);

    Route::post('/logout', [ApiPostController::class, 'logout']);

//    Route::post('refresh', 'AuthController@refresh');
//    Route::post('me', 'AuthController@me');

});
