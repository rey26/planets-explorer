<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}
