<?php

Route::group(['middleware' => ['csrftoken']], function () {
    resource('projects', ProjectsController::class);
});
