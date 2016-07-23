<?php

Route::group(['prefix' => 'api/v1'], function () {
    $controller = AppliancesController::class;

    Route::get('appliances', "$controller@index");
    Route::post('appliances', "$controller@store");
});
