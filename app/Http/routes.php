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

get('workflows/create', function () {
    return view('workflows.create');
})->name('workflows.create');

post('workflows', function () {
    $name = Request::input('name');

    $workflow = app(\App\Entities\Workflow::class)->create(compact('name'));

    return redirect()->route('workflows.show', $workflow->id);
})->name('workflows.store');

get('workflows/{id}', function ($id) {
    $workflow = app(\App\Entities\Workflow::class)->findOrFail($id);

    return view('workflows.show')->withWorkflow($workflow);
})->name('workflows.show');
