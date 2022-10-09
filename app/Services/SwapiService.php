<?php

namespace App\Services;

use App\Models\GravityStandard;
use App\Models\Planet;
use App\Models\Resident;
use App\Models\Species;
use App\Models\Terrain;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class SwapiService
{
    protected string $baseUri = 'https://swapi.py4e.com/api/';

    public function syncPlanets(): void
    {
        foreach (Arr::get(Http::get($this->baseUri . 'planets')->json(), 'results') as $planet) {
            /** @var Planet $localPlanet */
            $localPlanet = Planet::updateOrCreate(
                [
                    'name' => Arr::get($planet, 'name'),
                ],
                [
                    'name' => Arr::get($planet, 'name'),
                    'diameter' => Arr::get($planet, 'diameter'),
                    'rotation_period' => Arr::get($planet, 'rotation_period'),
                    'gravity_standard_id' => $this->getGravityStandardIdByName(Arr::get($planet, 'gravity')),
                ]
            );
            $localPlanet->terrains()->sync($this->getTerrainIds(Arr::get($planet, 'terrain')));
            $this->setResidents(Arr::get($planet, 'residents'), $localPlanet->id);
        }
    }

    private function setResidents(array $residentUrls, int $planetId): void
    {
        foreach ($residentUrls as $residentUrl) {
            $residentData = Http::get($residentUrl);
            /** @var Resident $resident */
            $resident = Resident::firstOrCreate([
                'name' => Arr::get($residentData, 'name'),
                'planet_id' => $planetId,
            ]);

            $resident->species()->sync($this->getSpeciesIds(Arr::get($residentData, 'species')));
        }
    }

    private function getSpeciesIds(array $speciesUrls): array
    {
        $speciesIds = [];

        foreach ($speciesUrls as $speciesUrl) {
            $speciesData = Http::get($speciesUrl);
            $speciesIds[] = Species::firstOrCreate([
                'name' => Arr::get($speciesData, 'name'),
            ])->id;
        }

        return $speciesIds;
    }

    private function getGravityStandardIdByName(string $name): int
    {
        return GravityStandard::firstOrCreate(['name' => $name])->id;
    }

    private function getTerrainIds(string $terrainNames): array
    {
        $terrainIds = [];

        foreach (explode(', ', $terrainNames) as $name) {
            $terrainIds[] = Terrain::firstOrCreate(['name' => $name])->id;
        }

        return $terrainIds;
    }
}
