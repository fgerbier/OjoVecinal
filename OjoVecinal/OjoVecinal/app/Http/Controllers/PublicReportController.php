<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class PublicReportController extends Controller
{
    public function comunidad()
    {
        $reportes = Report::with('comments')->latest()->paginate(10);
        return view('comunidad', ['reportes' => $reportes]);
    }

    public function comentar(Request $request, Report $report)
    {
        $request->validate([
            'contenido' => 'required|string|max:1000',
            'nombre' => 'nullable|string|max:255',
        ]);

        $report->comments()->create([
            'contenido' => $request->input('contenido'),
            'nombre' => $request->input('nombre'),
        ]);

        return redirect()->route('reportes.comunidad')->with('success', 'Comentario publicado correctamente.');
    }
}

