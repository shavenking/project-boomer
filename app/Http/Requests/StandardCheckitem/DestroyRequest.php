<?php

namespace App\Http\Requests\StandardCheckitem;

use App\Http\Requests\AuthorizeTraits\StandardChecklistCreatedByUser;
use App\Http\Requests\Request;

class DestroyRequest extends Request
{
    use StandardChecklistCreatedByUser;

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
