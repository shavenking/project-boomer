<?php

Route::group(['middleware' => ['csrftoken', 'localize']], function () {
    resource('projects', Projects\ProjectViewsController::class);
});
