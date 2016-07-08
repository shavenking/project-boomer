<?php

$controller = FaultImprovementsController::class;

Route::group(['prefix' => 'api/v1'], function () use ($controller) {
    Route::put('projects/{projects}/fault-improvements/{faultImprovements}', "$controller@update")->middleware('role:quality_manager|field_engineer');
    Route::post('projects/{projects}/fault-improvements/{faultImprovements}/photos/{step}', "$controller@storePhotos")->middleware('role:quality_manager|field_engineer');
});

Route::group(['middleware' => ['csrftoken']], function () use ($controller) {
    Route::get('projects/{projects}/fault-improvements', "$controller@index")->name('projects.fault-improvements.index');
    Route::get('projects/{projects}/fault-improvements/{faultImprovements}', "$controller@show")->name('projects.fault-improvements.show');
    Route::put('projects/{projects}/fault-improvements/{faultImprovements}', "$controller@update")->name('projects.fault-improvements.update')->middleware('role:quality_manager|field_engineer');
});
