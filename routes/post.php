<?php
use App\Http\Controllers\PostController;


use Illuminate\Support\Facades\Route;

Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
Route::get('/posts', [PostController::class, 'index'])->name('post.index');




Route::post('/post/store', [PostController::class, 'store'])->name('post.store');

Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
Route::get('/posts/{post}/show', [PostController::class, 'show'])->name('post.show');
Route::put('/posts/{post}', [PostController::class, 'update'])->name('post.update');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('post.destroy');

Route::get('/posts/search', [PostController::class, 'search'])->name('post.search');


// routes/web.php

Route::get('/export-posts', [PostController::class, 'exportCsv'])->name('export.posts');



