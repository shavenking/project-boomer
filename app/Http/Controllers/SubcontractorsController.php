<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\StandardSubcontractor\StoreRequest;
use App\Http\Controllers\Controller;

use App\Entities\Subcontractor;

class SubcontractorsController extends Controller
{
    public function index(Request $request)
    {
        $subcontractors = Subcontractor::all();

        if ($request->ajax()) {
            return response()->json(compact('subcontractors'));
        }

        return view('subcontractors.index')->withSubcontractors($subcontractors);
    }

    public function create()
    {
        return view('subcontractors.create');
    }

    public function store(StoreRequest $request)
    {
        $user = $request->user();
        $user->subcontractors()->create($request->only('name'));

        return redirect()->route('subcontractors.index');
    }
}
