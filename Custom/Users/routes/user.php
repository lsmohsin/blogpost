<?php

use package\Http\Controllers\UserController;




Route::get('/users', [Custom\Users\Http\Controllers\UserController::class, 'index'])->name('user.index');
Route::get('/create', [Custom\Users\Http\Controllers\UserController::class, 'create'])->name('user.create');
Route::post('/store', [Custom\Users\Http\Controllers\UserController::class, 'store'])->name('package.user.store');



Route::get('/edit/{id}', [Custom\Users\Http\Controllers\UserController::class, 'edit'])->name('package.user.edit');
Route::put('/update/{id}', [Custom\Users\Http\Controllers\UserController::class, 'update'])->name('package.user.update');
Route::delete('/destroy/{id}', [Custom\Users\Http\Controllers\UserController::class, 'destroy'])->name('package.user.destroy');

Route::get('/user/{id}', [Custom\Users\Http\Controllers\UserController::class, 'show'])->name('package.user.show');
