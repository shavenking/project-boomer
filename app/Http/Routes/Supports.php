<?php
Route::group(['prefix' => 'api/v1'], function () {
    resource('mainflow-types', Support\MainflowTypesController::class);
    resource('mainflow-types.detailingflow-types', Support\DetailingflowTypesController::class);
    resource('cost-types', Support\CostTypesController::class);
    resource('units', Support\UnitsController::class);
});
