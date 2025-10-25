<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PublicReportController;


//Ruta de los reportes
Route::post('/reportes', [ReportController::class, 'store'])->name('reportes.store');
Route::middleware(['auth'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::put('/reports/{report}/estado', [ReportController::class, 'cambiarEstado'])->name('reports.cambiarEstado');
    Route::delete('/comentarios/{comentario}', [ReportController::class, 'eliminarComentario'])->name('comments.destroy');
    Route::get('/comentarios', [ReportController::class, 'comentarios'])->name('comments.index');
});

// Ruta de los comentarios

Route::get('/reportes', [PublicReportController::class, 'comunidad'])->name('reportes.comunidad');
Route::post('/reportes/{report}/comentar', [PublicReportController::class, 'comentar'])->name('reportes.comentar');

//Ruta Home
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [ReportController::class, 'dashboard'])
    ->middleware(['auth', 'admin']) // si estás usando middleware admin, si no, deja 'auth'
    ->name('dashboard');
//Ruta Perfil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
