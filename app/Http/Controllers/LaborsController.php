<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Entities\{ Project, Labor };

class LaborsController extends Controller
{
    public function index()
    {
        $labors = Labor::all();

        return response()->json([
            'labors' => $labors
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $labor = Labor::create(['name' => $request->input('name')]);

        return response()->json(compact('labor'));
    }
}
