<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Planet extends Model
{
    use HasFactory;

    public function gravityStandard(): BelongsTo
    {
        return $this->belongsTo(GravityStandard::class);
    }
}
