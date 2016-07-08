<?php

namespace App\Http\Requests\Project;

use App\Repos\Contracts\Project as ProjectRepo;
use App\Http\Requests\Request;

class ShowRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(ProjectRepo $repo)
    {
        $user = $this->user();
        $project = $repo->findOrFail($this->route('projects'));

        return $repo->isUserInProject($user, $project);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
