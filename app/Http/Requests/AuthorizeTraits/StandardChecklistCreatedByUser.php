<?php

namespace App\Http\Requests\AuthorizeTraits;

use App\Entities\Checklist;

trait StandardChecklistCreatedByUser
{
    public function authorize()
    {
        $user = $this->user();

        if (!$user) {
            return false;
        }

        $checklistId = $this->route('checklists');
        $checklist = Checklist::findOrFail($checklistId);

        return $user->id === $checklist->user_id;
    }
}
