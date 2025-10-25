<?php

// app/Models/Report.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
    'titulo',
    'fecha_incidente',
    'nombre',
    'email',
    'categorias',
    'descripcion',
    'foto',
    'ubicacion_aproximada',
    'latitud',
    'longitud',
];

public function comments()
    {
        return $this->hasMany(ReportComment::class, 'report_id'); // o 'reporte_id' si así se llama tu FK
    }

    
}


