<?php

Route::group(['middleware' => ['csrftoken']], function () {
    get('works/{work}/checklist', WorksController::class . '@checklist')->name('works.checklist');
    get('works/{work}/workflow', WorksController::class . '@workflow')->name('works.workflow');
    get('works/{work}/work-items', WorksController::class . '@workItems')->name('works.work-items.index');
    resource('works', WorksController::class);
});

Route::group(['prefix' => 'api/v1'], function () {
    get('works/{works}/work-items', WorksController::class . '@indexOfWorkitems');
    post('works/{works}/work-items', WorksController::class . '@storeOfWorkitems');
    put('works/{works}/work-items/{workitems}', WorksController::class . '@updateOfWorkitems');
    delete('works/{works}/work-items/{workitems}', WorksController::class . '@destroyOfWorkitems');

    resource('works', WorksController::class);
});
