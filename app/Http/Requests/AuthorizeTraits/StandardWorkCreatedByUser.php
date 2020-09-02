<?php

namespace App\Http\Requests\AuthorizeTraits;

use App\Entities\Work;

trait StandardWorkCreatedByUser
{
    public function authorize()
    {
        $user = $this->user();

        if (!$user) {
            return false;
        }

        $workId = $this->route('works');
        $work = Work::findOrFail($workId);

        return $user->id === $work->user_id;
    }
}
