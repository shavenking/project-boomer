<?php

namespace App\Http\Requests\StandardWorkflow;

use App\Http\Requests\AuthorizeTraits\StandardWorkflowCreatedByUser;
use App\Http\Requests\Request;

class UpdateRequest extends Request
{
    use StandardWorkflowCreatedByUser;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required'
        ];
    }
}
