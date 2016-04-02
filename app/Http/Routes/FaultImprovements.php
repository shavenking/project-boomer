<?php

Route::group(['middleware' => ['csrftoken']], function () {
    resource('projects.fault-improvements', FaultImprovementsController::class);
});
