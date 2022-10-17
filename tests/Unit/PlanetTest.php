<?php

namespace Tests\Unit;

use App\Models\GravityStandard;
use App\Models\Planet;
use App\Models\Resident;
use App\Models\Species;
use App\Models\Terrain;
use Database\Factories\SpeciesFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlanetTest extends TestCase
{
    use WithFaker;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_planet_has_relations()
    {
        $gravityStandard = GravityStandard::factory()->create();
        $planet = Planet::factory()
            ->for($gravityStandard)
            ->has(Terrain::factory()->count(3))
            ->has(Resident::factory()->count(10)->has(Species::factory()->count(2)))
            ->create();

        $this->assertEquals($gravityStandard->id, $planet->gravityStandard->id);
        $this->assertEquals($planet->residents->count(), 10);
        $this->assertEquals(3, $planet->terrains->count());
    }
}
