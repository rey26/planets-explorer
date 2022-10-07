<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resident extends Model
{
    use HasFactory;

    public function species(): BelongsTo
    {
        return $this->belongsTo(ResidentSpecies::class);
    }

    public function planet(): BelongsTo
    {
        return $this->belongsTo(Planet::class);
    }
}
