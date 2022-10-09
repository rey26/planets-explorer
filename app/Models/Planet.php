<?php

namespace App\Models;

use App\Models\Resident;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Arr;

class Planet extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function gravityStandard(): BelongsTo
    {
        return $this->belongsTo(GravityStandard::class);
    }

    public function terrains(): BelongsToMany
    {
        return $this->belongsToMany(Terrain::class);
    }

    public function residents(): HasMany
    {
        return $this->hasMany(Resident::class);
    }

    public function scopeFilters(Builder $query, array $data): Builder
    {
        return $query
            ->when(Arr::get($data, 'diameterFrom'), function (Builder $query) use ($data) {
                return $query->where('diameter', '>=', Arr::get($data, 'diameterFrom'));
            })
            ->when(Arr::get($data, 'diameterTo'), function (Builder $query) use ($data) {
                return $query->where('diameter', '<=', Arr::get($data, 'diameterTo'));
            })
            ->when(Arr::get($data, 'rotationPeriodFrom'), function (Builder $query) use ($data) {
                return $query->where('rotation_period', '>=', Arr::get($data, 'rotationPeriodFrom'));
            })
            ->when(Arr::get($data, 'rotationPeriodTo'), function (Builder $query) use ($data) {
                return $query->where('rotation_period', '<=', Arr::get($data, 'rotationPeriodTo'));
            })
            ->when(Arr::get($data, 'gravity'), function (Builder $query) use ($data) {
                return $query->where('gravity_standard_id', Arr::get($data, 'gravity'));
            });
    }

    public static function getTerrainDistribution(): array
    {
        $terrains = [];
        $usedTerrainsCount = 0;

        foreach (Planet::all() as $planet) {
            $usedTerrainsCount += $planet->terrains->count();
        }

        foreach (Terrain::all() as $terrain) {
            $terrains[$terrain->name] = round(($terrain->planets->count() / $usedTerrainsCount) * 100, 2);
        }

        return $terrains;
    }

    public static function getAllLivingSpecies(): array
    {
        $livingSpecies = [];

        foreach (Planet::all() as $planet) {
            /** @var Resident $resident */
            foreach ($planet->residents as $resident) {
                foreach ($resident->species as $species) {
                    if (
                        Arr::has($livingSpecies, $planet->name) &&
                        Arr::has($livingSpecies[$planet->name], $species->name)
                    ) {
                        $livingSpecies[$planet->name][$species->name] += 1;
                    } else {
                        $livingSpecies[$planet->name][$species->name] = 1;
                    }
                }
            }
        }

        return $livingSpecies;
    }
}
