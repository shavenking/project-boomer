<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Entities\{ Project, DailyLabor };

class DailyLaborsController extends Controller
{
    public function index()
    {
        $dailyLabors = DailyLabor::all();

        return response()->json([
            'daily_labors' => $dailyLabors
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $dailyLabor = DailyLabor::create(['name' => $request->input('name')]);

        return response()->json();
    }
}
