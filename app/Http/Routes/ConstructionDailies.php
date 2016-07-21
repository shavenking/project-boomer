<?php

$controller = ConstructionDailiesController::class;

Route::group(['middleware' => ['csrftoken', 'role:*']], function () use ($controller) {
    Route::get('projects/{projects}/construction-dailies/{date}', "$controller@show")->name('projects.construction-dailies.show');
    Route::get('projects/{projects}/construction-dailies', "$controller@index")->name('projects.construction-dailies.index');
});

Route::group(['prefix' => 'api/v1'], function () use ($controller) {
    Route::get(
        'projects/{projects}/construction-dailies/{date}/labors',
        "$controller@getLabors"
    );

    Route::post(
        'projects/{projects}/construction-dailies/{date}/labors',
        "$controller@addLabor"
    )->middleware('role:project_manager|field_engineer');
});
