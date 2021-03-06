<?php

// 請勿調整順序
Route::group(['middleware' => 'auth.basic'], function () {
    require(app_path('Http/Routes/Works.php'));
    require(app_path('Http/Routes/Workflows.php'));
    require(app_path('Http/Routes/ProjectWorks.php'));
    require(app_path('Http/Routes/Checklists.php'));
    require(app_path('Http/Routes/ProjectChecklists.php'));
    require(app_path('Http/Routes/ConstructionDailies.php'));
    require(app_path('Http/Routes/CostEstimations.php'));
    require(app_path('Http/Routes/FaultImprovements.php'));
    require(app_path('Http/Routes/Bids.php'));
    require(app_path('Http/Routes/DailyMaterials.php'));
    require(app_path('Http/Routes/DailyLabors.php'));
    require(app_path('Http/Routes/DailyAppliances.php'));
    require(app_path('Http/Routes/DailyRecords.php'));
    require(app_path('Http/Routes/Projects.php'));
    require(app_path('Http/Routes/Subcontractors.php'));
    require(app_path('Http/Routes/Supports.php'));
    require(app_path('Http/Routes/Miscs.php'));
});
