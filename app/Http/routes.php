<?php

Route::group(['prefix' => 'api/v1'], function () {
    resource('workflows', Workflows\WorkflowsController::class);
});
