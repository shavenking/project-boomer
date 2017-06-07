<?php

namespace App\Http\Requests\StandardWorkitem;

use App\Http\Requests\AuthorizeTraits\StandardWorkCreatedByUser;
use App\Http\Requests\Request;

class StoreRequest extends Request
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
            'unit_id' => 'required',
            'cost_type_id' => 'required',
            'name' => 'required',
            'order' => 'required',
            'amount' => 'required',
            'unit_price' => 'required'
        ];
    }
}
