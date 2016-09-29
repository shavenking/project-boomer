<?php

namespace App\Repos;

use App\Entities\Review;
use App\User;

class ReviewRepo
{
    protected $process = [
        'bid' => ['cost_manager', 'project_manager'],
        'construction_daily' => ['engineer', 'field_engineer', 'project_manager'],
        'project_checklist' => ['quality_manager', 'field_engineer', 'project_manager'],
        'fault_improvement' => ['quality_manager', 'field_engineer', 'project_manager'],
        'cost_estimation' => ['estimation_manager', 'project_manager']
    ];

    public function getLatestReview($resourceType, $resourceId)
    {
        $review = Review::whereResourceType($resourceType)
            ->whereResourceId($resourceId)
            ->latest()
            ->first();

        return $review;
    }

    public function createSubmission($resourceType, $resourceId, $roleName)
    {
        return Review::create([
            'resource_type' => $resourceType,
            'resource_id' => $resourceId,
            'status' => 'submitted',
            'role_name' => $roleName
        ]);
    }

    public function isNextStepSubmission($latestReview)
    {
        if (is_null($latestReview)) {
            return true;
        }

        if (
            $latestReview instanceof Review
            && $latestReview->status == 'canceled'
        ) {
            return true;
        }

        return false;
    }

    public function canUserCreateSubmission($resourceType, $resourceId, $roleName)
    {
        $currentProcess = collect($this->process[$resourceType]);

        if ($roleName === $currentProcess->first()) {
            return true;
        }

        return false;
    }

    public function isMyReview($latestReview, $roleName)
    {
        if (is_null($latestReview)) {
            return false;
        }

        $resourceType = $latestReview->getAttribute('resource_type');

        $currentProcess = collect($this->process[$resourceType]);

        $latestRoleIdx = $currentProcess->search($latestReview->role_name);
        if (false === $latestRoleIdx) {
            return false;
        }

        $nextRole = $currentProcess->get($latestRoleIdx+1);
        if ($nextRole === $roleName) {
            return true;
        }

        return false;
    }

    public function accept($resourceType, $resourceId, $roleName)
    {
        $currentProcess = collect($this->process[$resourceType]);

        if ($currentProcess->last() === $roleName) {
            return $this->createReview($resourceType, $resourceId, $roleName, 'finished');
        }

        return $this->createReview($resourceType, $resourceId, $roleName, 'accepted');
    }

    public function cancelReview($resourceType, $resourceId)
    {
        return Review::whereResourceType($resourceType)
            ->whereResourceId($resourceId)
            ->delete();
    }

    protected function createReview($resourceType, $resourceId, $roleName, $status)
    {
        return Review::create([
            'resource_type' => $resourceType,
            'resource_id' => $resourceId,
            'role_name' => $roleName,
            'status' => $status
        ]);
    }
}
