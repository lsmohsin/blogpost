<?php






Route::get('/users', [Custom\Users\Http\Controllers\UserController::class, 'index'])->name('user.index');
