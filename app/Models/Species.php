<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Species extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function residents(): BelongsToMany
    {
        return $this->belongsToMany(Resident::class, 'resident_species', 'resident_id', 'species_id');
    }
}
