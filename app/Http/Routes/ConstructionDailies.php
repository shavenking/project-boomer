<?php

Route::group(['middleware' => ['csrftoken', 'localize']], function () {
    resource('projects.construction-dailies', ConstructionDailiesController::class);
});
