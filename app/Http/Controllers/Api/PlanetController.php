<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Planet;
use Illuminate\Http\JsonResponse;

class PlanetController extends Controller
{
    public function index()
    {
        return new JsonResponse([
            'largestPlanets' => Planet::orderBy('diameter', 'desc')->limit(10)->pluck('name')->implode(', '),
            'terrainDistribution' => Planet::getTerrainDistribution(),
            'speciesByPlanet' => Planet::getAllLivingSpecies(),
        ]);
    }
}
