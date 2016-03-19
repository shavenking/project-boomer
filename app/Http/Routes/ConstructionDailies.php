<?php

Route::group(['middleware' => ['csrftoken', 'localize']], function () {
    resource('projects.construction-dailies', Projects\ConstructionDailiesController::class);
});
