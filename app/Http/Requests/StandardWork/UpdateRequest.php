<?php

namespace App\Http\Requests\StandardWork;

use App\Http\Requests\AuthorizeTraits\StandardWorkCreatedByUser;
use App\Http\Requests\Request;

class UpdateRequest extends Request
{
    use StandardWorkCreatedByUser;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'detailingflow_type_id' => 'required',
            'unit_id' => 'required',
            'workflow_id' => 'required',
            'name' => 'required',
            'amount' => 'required'
        ];
    }
}
