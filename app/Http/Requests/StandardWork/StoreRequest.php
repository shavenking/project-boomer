<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

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
