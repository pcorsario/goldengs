<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Estudiante extends Model
{
    public function representante(): BelongsTo
    {
        return $this->belongsTo(Representante::class);
    }
    public function servicios(): HasMany
    {
        return $this->hasMany(Servicio::class);
    }
}
