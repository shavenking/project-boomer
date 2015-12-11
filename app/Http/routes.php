<?php

Route::group(['prefix' => 'api/v1'], function () {
    resource('workflows', Workflows\WorkflowsController::class);
    resource('workflows.nodes', Workflows\NodesController::class);
});

get('settings', function () {
    return view('settings.index');
})->name('settings.index');

resource('workflows', Workflows\WorkflowViewsController::class);

resource('projects', projects\ProjectViewsController::class);
