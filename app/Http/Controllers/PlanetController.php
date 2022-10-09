<?php

namespace App\Http\Controllers;

use App\Models\GravityStandard;
use App\Models\Planet;
use Illuminate\Http\Request;

class PlanetController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->all();
        $planets = Planet::filters($filters)->paginate(3);

        return view('planets')
            ->with('planets', $planets)
            ->with('filters', $filters)
            ->with('gravityStandards', GravityStandard::all()->pluck('name', 'id')->toArray());
    }
}
