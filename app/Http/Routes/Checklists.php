<?php

Route::group(['prefix' => 'api/v1'], function () {
    resource('checklists.checkitems', Checklists\CheckitemsController::class);
    resource('checklists', Checklists\ChecklistsController::class);
});

Route::group(['middleware' => ['csrftoken', 'localize']], function () {
    get('checklists/{checklist}/works', Checklists\ChecklistsViewController::class . '@works')->name('checklists.works');
    get('checklist/{checklist}/workflow', Checklists\ChecklistsViewController::class . '@workflow')->name('checklists.workflow');
    resource('checklists.checkitems', Checklists\CheckitemsViewController::class);
    resource('checklists', Checklists\ChecklistsViewController::class);
});
