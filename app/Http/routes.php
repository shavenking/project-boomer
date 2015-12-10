<?php

Route::group(['prefix' => 'api/v1'], function () {
    resource('workflows', Workflows\WorkflowsController::class);
    resource('workflows.items', Workflows\ItemsController::class);
});

get('settings', function () {
    return view('settings.index');
})->name('settings.index');

get('workflows', function () {
    return view('workflows.index');
})->name('workflows.index');
