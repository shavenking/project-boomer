<?php

Route::group(['middleware' => ['csrftoken']], function () {
    resource('subcontractors', SubcontractorsController::class);
});
