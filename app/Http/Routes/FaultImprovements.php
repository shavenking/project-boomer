<?php

Route::group(['middleware' => ['csrftoken', 'localize']], function () {
    resource('projects.fault-improvements', Projects\FaultImprovementsController::class);
});
