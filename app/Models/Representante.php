<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Representante extends Model
{
    public function estudiantes(): HasMany
    {
        return $this->hasMany(Estudiante::class);
    }
}
