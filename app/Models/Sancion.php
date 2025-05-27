<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sancion extends Model
{
    use HasFactory;

    protected $table = 'sanciones'; // Solo necesario si la tabla tiene otro nombre
    
    protected $fillable = [
        'docente_id',
        'numero_resolucion',
        'fecha_emision',
        'tipo_sancion',
        'antecedentes',
        'fundamentos',
        'resolucion',
        'firma_path',
        'fecha_notificacion',
        'estado',
        'notificado_por'
    ];

    protected $dates = [
        'fecha_emision',
        'fecha_notificacion',
        'created_at',
        'updated_at'
    ];

    // Relación con docente
    public function docente()
    {
        return $this->belongsTo(Docente::class, 'docente_id');
    }
}