<?php

Route::group(['middleware' => ['csrftoken']], function () {
    put('projects/{project}/checklists/{checklist}/checkresults', ProjectChecklistsController::class . '@updateCheckitemsResults')->name('projects.checklists.checkresults.update');
    resource('projects.checklists', ProjectChecklistsController::class);
});
