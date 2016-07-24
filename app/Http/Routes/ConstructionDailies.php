<?php

$controller = ConstructionDailiesController::class;

Route::group(['middleware' => ['csrftoken', 'role:*']], function () use ($controller) {
    Route::get('projects/{projects}/construction-dailies/{date}', "$controller@show")->name('projects.construction-dailies.show');
    Route::get('projects/{projects}/construction-dailies', "$controller@index")->name('projects.construction-dailies.index');
    Route::post(
        'projects/{projects}/construction-dailies',
        "$controller@store"
    )->name('projects.construction-dailies.store');
});

Route::group(['prefix' => 'api/v1'], function () use ($controller) {
    Route::get(
        'projects/{projects}/construction-dailies/{date}',
        "$controller@show"
    );
    Route::put(
        'projects/{projects}/construction-dailies/{date}',
        "$controller@update"
    )->middleware('role:project_manager|field_engineer');

    Route::get(
        'projects/{projects}/construction-dailies/{date}/labors',
        "$controller@getLabors"
    );
    Route::get(
        'projects/{projects}/construction-dailies/{date}/materials',
        "$controller@getMaterials"
    );
    Route::get(
        'projects/{projects}/construction-dailies/{date}/appliances',
        "$controller@getAppliances"
    );
    Route::get(
        'projects/{projects}/construction-dailies/{date}/works',
        "$controller@getWorks"
    );

    Route::post(
        'projects/{projects}/construction-dailies/{date}/labors',
        "$controller@addLabor"
    )->middleware('role:project_manager|field_engineer');
    Route::post(
        'projects/{projects}/construction-dailies/{date}/materials',
        "$controller@addMaterial"
    )->middleware('role:project_manager|field_engineer');
    Route::post(
        'projects/{projects}/construction-dailies/{date}/appliances',
        "$controller@addAppliance"
    )->middleware('role:project_manager|field_engineer');
    Route::post(
        'projects/{projects}/construction-dailies/{date}/works',
        "$controller@addWork"
    )->middleware('role:project_manager|field_engineer');
});
