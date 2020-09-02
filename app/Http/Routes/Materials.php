<?php

Route::group(['prefix' => 'api/v1'], function () {
    $controller = MaterialsController::class;

    Route::get('materials', "$controller@index");
    Route::post('materials', "$controller@store");
});
