<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Entities\Subcontractor;

class SubcontractorsController extends Controller
{
    public function index()
    {
        $subcontractors = subcontractor::all();

        return view('subcontractors.index')->withSubcontractors($subcontractors);
    }

}
