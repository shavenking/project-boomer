<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Entities\{ Project, Material };

class MaterialsController extends Controller
{
    public function index()
    {
        $materials = Material::all();

        return response()->json([
            'materials' => $materials
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $material = Material::create(['name' => $request->input('name')]);

        return response()->json(compact('material'));
    }
}
