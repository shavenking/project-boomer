<?php

namespace App\Http\Requests\StandardWorkflowitem;

use App\Http\Requests\AuthorizeTraits\StandardWorkflowCreatedByUser;
use App\Http\Requests\Request;

class StoreRequest extends Request
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
            'order' => 'required',
            'title' => 'required'
        ];
    }
}
