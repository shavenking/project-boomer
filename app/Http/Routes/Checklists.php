<?php

Route::group(['prefix' => 'api/v1'], function () {
    post('checklists/{checklists}/checkitems', ChecklistsController::class . '@storeCheckitem');
    resource('checklists', ChecklistsController::class);
});

Route::group(['middleware' => ['csrftoken']], function () {
    get('checklists/{checklist}/works', ChecklistsController::class . '@works')->name('checklists.works');
    get('checklist/{checklist}/workflow', ChecklistsController::class . '@workflow')->name('checklists.workflow');
    post('checklists/{checklists}/checkitems', ChecklistsController::class . '@storeCheckitem')->name('checklists.checkitems.store');
    resource('checklists', ChecklistsController::class);
});
