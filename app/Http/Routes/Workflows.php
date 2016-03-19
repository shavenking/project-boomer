<?php
Route::group(['prefix' => 'api/v1'], function () {
    resource('workflows', Workflows\WorkflowsController::class);
    resource('workflows.nodes', Workflows\NodesController::class);
});

Route::group(['middleware' => ['csrftoken', 'localize']], function () {
    get('workflows/{workflow}/checklist', Workflows\WorkflowViewsController::class . '@checklist')->name('workflows.checklist');
    get('workflows/{workflow}/works', Workflows\WorkflowViewsController::class . '@works')->name('workflows.works');
    resource('workflows', Workflows\WorkflowViewsController::class);
});
