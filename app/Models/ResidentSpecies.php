<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ResidentSpecies extends Model
{
    use HasFactory;

    public function residents(): HasMany
    {
        return $this->hasMany(Resident::class);
    }
}
