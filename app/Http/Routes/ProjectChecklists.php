<?php

Route::group(['middleware' => ['csrftoken', 'localize']], function () {
    put('projects/{project}/checklists/{checklist}/checkresults', Projects\ChecklistsController::class . '@updateCheckitemsResults')->name('projects.checklists.checkresults.update');
    resource('projects.checklists', Projects\ChecklistsController::class);
});
