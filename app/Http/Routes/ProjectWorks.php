<?php
Route::group(['prefix' => 'api/v1'], function () {
    get('projects/{projects}/works/{works}/workitems', ProjectWorksController::class . '@indexOfWorkitems');
    get('projects/{projects}/works/{works}/workitems/create', ProjectWorksController::class . '@createOfWorkitems');
    post('projects/{projects}/works/{works}/workitems', ProjectWorksController::class . '@storeOfWorkitems');
    put('projects/{projects}/works/{works}/workitems/{workitems}', ProjectWorksController::class . '@updateOfWorkitems');
    delete('projects/{projects}/works/{works}/workitems/{workitems}', ProjectWorksController::class . '@destroyOfWorkitems');

    resource('projects.works', ProjectWorksController::class);
});
Route::group(['middleware' => ['csrftoken', 'localize']], function () {
    get('projects/{projects}/works/{works}/workitems', ProjectWorksController::class . '@indexOfWorkitems')
        ->name('projects.works.workitems.index');
    get('projects/{projects}/works/{works}/workitems/create', ProjectWorksController::class . '@createOfWorkitems')
        ->name('projects.works.workitems.create');
    post('projects/{projects}/works/{works}/workitems', ProjectWorksController::class . '@storeOfWorkitems')
        ->name('projects.works.workitems.store');
    put('projects/{projects}/works/{works}/workitems/{workitems}', ProjectWorksController::class . '@updateOfWorkitems')
        ->name('projects.works.workitems.update');
    delete('projects/{projects}/works/{works}/workitems/{workitems}', ProjectWorksController::class . '@destroyOfWorkitems')
        ->name('projects.works.workitems.destroy');

    get('projects/{project}/works/search', ProjectWorksController::class . '@search')->name('projects.works.search');
    resource('projects.works', ProjectWorksController::class);
});
