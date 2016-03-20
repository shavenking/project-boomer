<?php

Route::group(['middleware' => ['csrftoken', 'localize']], function () {
    resource('projects.fault-improvements', FaultImprovementsController::class);
});
