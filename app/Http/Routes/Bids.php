<?php

Route::group(['middleware' => ['csrftoken', 'localize']], function () {
    get('projects/{project}/bid', BidsController::class . '@index')->name('projects.bid.index');
    get('projects/{project}/bid/works', BidsController::class . '@works')->name('projects.bid.works');
});
