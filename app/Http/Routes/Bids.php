<?php

Route::group(['middleware' => ['csrftoken', 'role:*']], function () {
    Route::get('projects/{projects}/bid/works', BidsController::class . '@works')->name('projects.bid.works');
    Route::get('projects/{projects}/bid.pdf', BidsController::class . '@pdf')->name('projects.bid.pdf');
});
