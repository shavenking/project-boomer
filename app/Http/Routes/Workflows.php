<?php
Route::group(['prefix' => 'api/v1'], function () {
    get('workflows/{workflows}/nodes', WorkflowsController::class . '@indexOfNodes');
    get('workflows/{workflows}/nodes/{nodes}', WorkflowsController::class . '@showOfNodes');
    post('workflows/{workflows}/nodes', WorkflowsController::class . '@storeOfNodes');
    put('workflows/{workflows}/nodes/{nodes}', WorkflowsController::class . '@updateOfNodes');
    delete('workflows/{workflows}/nodes/{nodes}', WorkflowsController::class . '@destroyOfNodes');
    resource('workflows', WorkflowsController::class);
});

Route::group(['middleware' => ['csrftoken']], function () {
    get('workflows/{workflow}/checklist', WorkflowsController::class . '@checklist')->name('workflows.checklist');
    get('workflows/{workflow}/works', WorkflowsController::class . '@works')->name('workflows.works');
    get('workflows/{workflow}/works/create', WorkflowsController::class . '@createWork')->name('workflows.createWork');
    get('workflows/{workflow}/works/{work}/work-items', WorkflowsController::class . '@showWorkItems')->name('workflows.showWorkItems');
    post('workflows/{workflow}/works', WorkflowsController::class . '@storeWork')->name('workflows.storeWork');
    resource('workflows', WorkflowsController::class);
});
