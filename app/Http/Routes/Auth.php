<?php

Route::group(['prefix' => 'auth'], function () {
    Route::get('login', Auth\AuthController::class . '@getLogin')->name('auth.get.login');
    Route::post('login', Auth\AuthController::class . '@postLogin')->name('auth.post.login');
    Route::get('logout', Auth\AuthController::class . '@getLogout')->name('auth.logout');

    Route::get('register', Auth\AuthController::class . '@getRegister')->name('auth.get.register');
    Route::post('register', Auth\AuthController::class . '@postRegister')->name('auth.post.register');
});
