<?php

namespace App\Http\Requests\StandardWorkitem;

use App\Http\Requests\AuthorizeTraits\StandardWorkCreatedByUser;
use App\Http\Requests\Request;

class DestroyRequest extends Request
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
