<?php

Route::group(['prefix' => 'api/v1'], function () {
    get('projects/{projects}/checklists', ProjectChecklistsController::class . '@index');
    post('projects/{projects}/checklists', ProjectChecklistsController::class . '@store');
});

Route::group(['middleware' => ['csrftoken']], function () {
    put('projects/{project}/checklists/{checklist}/checkresults', ProjectChecklistsController::class . '@updateCheckitemsResults')->name('projects.checklists.checkresults.update');
    resource('projects.checklists', ProjectChecklistsController::class);
});
