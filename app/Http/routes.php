<?php

Route::group(['prefix' => 'api/v1'], function () {
    resource('workflows', Workflows\WorkflowsController::class);
    resource('workflows.nodes', Workflows\NodesController::class);

    resource('mainflow-types', Support\MainflowTypesController::class);
    resource('mainflow-types.detailingflow-types', Support\DetailingflowTypesController::class);

    resource('cost-types', Support\CostTypesController::class);

    resource('units', Support\UnitsController::class);
});

get('settings', function () {
    return view('settings.index');
})->name('settings.index');

resource('workflows', Workflows\WorkflowViewsController::class);

resource('projects', Projects\ProjectViewsController::class);
