<?php

Route::group(['prefix' => 'projects/{projects}/members'], function () {
    $controller = ProjectMembersController::class;

    Route::get('/', "$controller@index")->name('projects.members.index')->middleware('role:*');
    Route::post('/', "$controller@store")->name('projects.members.store')->middleware('role:project_manager|project_manager');

    Route::get('create', "$controller@create")->name('projects.members.create')->middleware('role:project_manager|project_manager');

    Route::delete('{members}', "$controller@destroy")->name('projects.members.destroy')->middleware('role:project_manager|project_manager');
});
