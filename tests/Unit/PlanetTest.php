<?php

namespace Tests\Unit;

use App\Models\GravityStandard;
use App\Models\Planet;
use Database\Factories\GravityStandardFactory;
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
    public function test_relations()
    {
        $gravityStandard = GravityStandard::factory()->create();
        $planet = Planet::factory()
            ->for($gravityStandard)
            ->create();

        $this->assertEquals($gravityStandard->id, $planet->gravityStandard->id);
    }
}
