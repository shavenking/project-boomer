<?php

Route::group(['prefix' => 'api/v1/projects/{projects}'], function () {
    $repo = new App\Repos\ReviewRepo;

    Route::get('review', function ($projectId) use ($repo) {
        $resourceType = Request::input('resource_type');
        $resourceId = Request::input('resource_id');

        // get next review step
        $latestReview = $repo->getLatestReview($resourceType, $resourceId);
        $roleName = Request::user()->roles($projectId)->first()->name;

        $nextSteps = [
            'submit' => $repo->canUserCreateSubmission($resourceType, $resourceId, $roleName, $projectId) && $repo->isNextStepSubmission($latestReview),
            'accept' => $repo->isMyReview($latestReview, $roleName, $projectId),
            'reject' => $repo->isMyReview($latestReview, $roleName, $projectId),
            'cancel' => $latestReview && $latestReview->status === 'finished' && $roleName === 'project_manager'
        ];

        return response()->json(compact('latestReview', 'nextSteps'));
    });

    /**
     * Create submission.
     */
    Route::post('reviews', function ($projectId) use ($repo) {
        $resourceType = Request::input('resource_type');
        $resourceId = Request::input('resource_id');

        $latestReview = $repo->getLatestReview($resourceType, $resourceId);

        if (!$repo->isNextStepSubmission($latestReview)) {
            // bad request
            return response()->json([], 400);
        }

        $roleName = Request::user()->roles($projectId)->first()->name;

        if (!$repo->canUserCreateSubmission($resourceType, $resourceId, $roleName, $projectId)) {
            // forbidden
            return response()->json([], 403);
        }

        // create a submission
        $review = $repo->createSubmission($resourceType, $resourceId, $roleName);

        return response()->json($review);
    });

    Route::put('review', function ($projectId) use ($repo) {
        $resourceType = Request::input('resource_type');
        $resourceId = Request::input('resource_id');
        $accepted = Request::input('accepted');

        $latestReview = $repo->getLatestReview($resourceType, $resourceId);
        $roleName = Request::user()->roles($projectId)->first()->name;

        if (!$repo->isMyReview($latestReview, $roleName, $projectId)) {
            return response()->json([], 403); // forbidden
        }

        if ($accepted) {
            $review = $repo->accept($resourceType, $resourceId, $roleName);

            return response()->json($review);
        }

        $latestReview->delete();

        return response()->json();
    });

    Route::delete('review', function ($projectId) use ($repo) {
        $resourceType = Request::input('resource_type');
        $resourceId = Request::input('resource_id');

        if (!Request::user()->hasRole('project_manager', $projectId)) {
            return response()->json([], 403);
        }

        $repo->cancelReview($resourceType, $resourceId);

        return response()->json();
    });
});
