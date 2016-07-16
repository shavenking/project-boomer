<?php

namespace App\Http\Requests\AuthorizeTraits;

use App\Entities\Workflow;

trait StandardWorkflowCreatedByUser
{
    public function authorize()
    {
        $user = $this->user();

        if (!$user) {
            return false;
        }

        $workflowId = $this->route('workflows');
        $workflow = Workflow::findOrFail($workflowId);

        return $user->id === $workflow->user_id;
    }
}
