<?php

Route::group(['middleware' => ['csrftoken', 'localize']], function () {
    get('works/{work}/checklist', Works\WorkViewsController::class . '@checklist')->name('works.checklist');
    get('works/{work}/workflow', Works\WorkViewsController::class . '@workflow')->name('works.workflow');
    get('works/{work}/work-items', Works\WorkViewsController::class . '@workItems')->name('works.work-items.index');
    resource('works', Works\WorkViewsController::class);
});

Route::group(['prefix' => 'api/v1'], function () {
    resource('works', Works\WorksController::class);
    resource('works.work-items', Works\WorkItemsController::class);
});
