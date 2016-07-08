<?php

Route::group(['middleware' => ['csrftoken']], function () {
    Route::get('projects/{project}/bid/works', BidsController::class . '@works')->name('projects.bid.works');
});
