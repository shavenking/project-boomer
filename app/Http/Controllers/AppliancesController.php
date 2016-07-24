<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Appliance;

class AppliancesController extends Controller
{
    public function index()
    {
        $appliances = Appliance::all();

        return response()->json([
            'appliances' => $appliances
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $appliance = Appliance::create(['name' => $request->input('name')]);

        return response()->json(compact('appliance'));
    }
}
