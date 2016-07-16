<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    public function forbiddenResponse()
    {
        if (!app('request')->ajax()) {
            return redirect()->back();
        }

        return response('Forbidden', 403);
    }
}
