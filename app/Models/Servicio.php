<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Servicio extends Model
{
    protected $fillable = [
        'fecha_pago',
        'nombre_servicio',
        'forma_pago',
        'nrocomprobante',
        'imagen',
        'notes',
        'estudiante_id',
        'valor'
    ];
    public function estudiante(): BelongsTo
    {
        return $this->belongsTo(Estudiante::class);
    }
}
