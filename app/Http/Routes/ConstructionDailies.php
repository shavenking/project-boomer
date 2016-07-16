<?php

Route::group(['middleware' => ['csrftoken', 'role:*']], function () {
    $controller = ConstructionDailiesController::class;

    Route::get('projects/{projects}/construction-dailies/{date}', "$controller@show")->name('projects.construction-dailies.show');
    Route::get('projects/{projects}/construction-dailies', "$controller@index")->name('projects.construction-dailies.index');
});
