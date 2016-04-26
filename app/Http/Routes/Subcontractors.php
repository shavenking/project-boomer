<?php

Route::group(['prefix' => 'api/v1'], function () {
    get('subcontractors', SubcontractorsController::class . '@index');
});

Route::group(['middleware' => ['csrftoken']], function () {
    resource('subcontractors', SubcontractorsController::class);
});
