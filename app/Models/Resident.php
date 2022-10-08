<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Resident extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function species(): BelongsToMany
    {
        return $this->belongsToMany(ResidentSpecies::class, 'resident_species', 'species_id');
    }

    public function planet(): BelongsTo
    {
        return $this->belongsTo(Planet::class);
    }
}
