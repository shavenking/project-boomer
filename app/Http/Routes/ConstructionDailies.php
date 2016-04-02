<?php

Route::group(['middleware' => ['csrftoken']], function () {
    resource('projects.construction-dailies', ConstructionDailiesController::class);
});
