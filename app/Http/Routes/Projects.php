<?php

Route::group(['middleware' => ['csrftoken']], function () {
    $controller = ProjectsController::class;

    Route::get('projects', "$controller@index")->name('projects.index');
    Route::get('projects/create', "$controller@create")->name('projects.create');
    Route::post('projects', "$controller@store")->name('projects.store');
    Route::get('projects/{projects}', "$controller@show")->middleware('role:*')->name('projects.show')->middleware('role:*');
    Route::delete('projects/{projects}', "$controller@destroy")->middleware('role:project_manager|project_manager')->name('projects.destroy');
});
