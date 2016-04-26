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
        $subcontractors = Subcontractor::all();

        return view('subcontractors.index')->withSubcontractors($subcontractors);
    }

    public function create()
    {
        return view('subcontractors.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        Subcontractor::create($request->only('name'));

        return redirect()->route('subcontractors.index');
    }
}
