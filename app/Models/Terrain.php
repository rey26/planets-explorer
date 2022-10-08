<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Terrain extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function planets(): BelongsToMany
    {
        return $this->belongsToMany(Planet::class);
    }
}
