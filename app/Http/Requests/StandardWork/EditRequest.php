<?php

namespace App\Http\Requests\StandardWork;

use App\Http\Requests\AuthorizeTraits\StandardWorkCreatedByUser;
use App\Http\Requests\Request;

class EditRequest extends Request
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
            //
        ];
    }
}
