<?php

Route::group(['middleware' => ['csrftoken', 'localize']], function () {
    resource('projects', ProjectsController::class);
});
