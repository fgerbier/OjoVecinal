<?php

// app/Models/ReportComment.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReportComment extends Model
{
    protected $fillable = ['report_id', 'nombre', 'contenido'];

    public function report()
    {
        return $this->belongsTo(Report::class, 'report_id');
    }
}
