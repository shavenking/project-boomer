<?php

Route::group(['middleware' => ['csrftoken', 'localize']], function () {
    get('projects/{project}/bid', Bids\BidViewsController::class . '@index')->name('projects.bid.index');
    get('projects/{project}/bid/works', Bids\BidViewsController::class . '@works')->name('projects.bid.works');
});
