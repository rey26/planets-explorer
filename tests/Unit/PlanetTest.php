<?php

namespace Tests\Unit;

use App\Models\GravityStandard;
use App\Models\Planet;
use App\Models\Terrain;
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
            ->create();

        $this->assertEquals($gravityStandard->id, $planet->gravityStandard->id);
        $this->assertEquals(3, $planet->terrains->count());
    }
}
