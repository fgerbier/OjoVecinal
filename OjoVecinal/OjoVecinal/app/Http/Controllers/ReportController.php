<?php

// app/Http/Controllers/ReportController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\ReportComment;
use Illuminate\Support\Facades\DB;
class ReportController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
    'titulo' => 'required|string|max:255',
    'fecha_incidente' => 'required|date',
    'nombre' => 'nullable|string|max:255',
    'email' => 'nullable|email',
    'categorias' => 'required|string',
    'descripcion' => 'required|string',
    'foto' => 'nullable|image|max:5120',
    'ubicacion_aproximada' => 'nullable|string',
    'latitud' => 'nullable|numeric',
    'longitud' => 'nullable|numeric',
]);

$data = $request->all();

if ($request->hasFile('foto')) {
    $data['foto'] = $request->file('foto')->store('reports/fotos', 'public');
}

Report::create($data);


    return redirect()->back()->with('success', 'Reporte enviado correctamente.');
}
 public function index(Request $request)
{
    $query = Report::query();

    if ($request->filled('desde')) {
        $query->whereDate('fecha_incidente', '>=', $request->desde);
    }

    if ($request->filled('hasta')) {
        $query->whereDate('fecha_incidente', '<=', $request->hasta);
    }

    $reportes = $query->latest()->paginate(10);

    return view('dashboard.reports.index', compact('reportes'));
}
// Controller
public function cambiarEstado(Request $request, Report $report)
{
    $request->validate([
        'estado' => 'required|in:pendiente,en_proceso,resuelto,descartado',
    ]);

    $report->estado = $request->estado;
    $report->save();

    return redirect()->route('dashboard.reports.index')->with('success', 'Estado actualizado correctamente.');
}
public function comentarios()
{
    $comentarios = ReportComment::with('report')
        ->latest()
        ->paginate(15); // puedes ajustar la paginación

    return view('dashboard.comments.index', compact('comentarios'));
}
public function eliminarComentario(ReportComment $comentario)
{
    $comentario->delete();

    return redirect()->route('dashboard.comments.index')->with('success', 'Comentario eliminado correctamente.');
}
public function dashboard()
{
    $reportesSinResolver = Report::where('estado', 'pendiente')->latest()->take(10)->get();

    $categorias = Report::select('categorias', DB::raw('count(*) as total'))
        ->groupBy('categorias')
        ->pluck('total', 'categorias');

    $fechas = Report::select(DB::raw('DATE(created_at) as fecha'), DB::raw('count(*) as total'))
        ->groupBy('fecha')
        ->orderBy('fecha')
        ->pluck('total', 'fecha');

    return view('dashboard', [
        'reportesSinResolver' => $reportesSinResolver,
        'categorias' => $categorias->keys(),
        'cantidades' => $categorias->values(),
        'fechas' => $fechas->keys(),
        'conteoFechas' => $fechas->values()
    ]);
}
}
