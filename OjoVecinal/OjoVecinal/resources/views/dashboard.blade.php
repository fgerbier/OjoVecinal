@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Gráfico de Categorías -->
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Reportes por Categoría</h2>
        <canvas id="chartCategorias"></canvas>
    </div>

    <!-- Gráfico de Fechas -->
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Reportes por Fecha</h2>
        <canvas id="chartFechas"></canvas>
    </div>
</div>

<!-- Reportes sin resolver -->
<div class="bg-white rounded shadow p-6 mt-6">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Reportes sin resolver</h2>
    <table class="min-w-full text-sm text-left text-gray-700">
        <thead class="bg-gray-100 text-xs uppercase text-gray-600">
            <tr>
                <th class="px-4 py-2">Título</th>
                <th class="px-4 py-2">Categoría</th>
                <th class="px-4 py-2">Fecha</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reportesSinResolver as $reporte)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $reporte->titulo }}</td>
                    <td class="px-4 py-2">{{ $reporte->categorias }}</td>
                    <td class="px-4 py-2">{{ $reporte->created_at->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-4 py-2 text-gray-500 text-center">No hay reportes pendientes.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Scripts para ChartJS --}}
<script>
    const categorias = @json($categorias);
    const cantidades = @json($cantidades);

    const fechas = @json($fechas);
    const conteoFechas = @json($conteoFechas);

    const ctx1 = document.getElementById('chartCategorias');
    new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: categorias,
            datasets: [{
                label: 'Cantidad',
                data: cantidades,
                backgroundColor: 'rgba(34,197,94,0.6)', // Verde
                borderColor: 'rgba(34,197,94,1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    const ctx2 = document.getElementById('chartFechas');
    new Chart(ctx2, {
        type: 'line',
        data: {
            labels: fechas,
            datasets: [{
                label: 'Reportes por día',
                data: conteoFechas,
                fill: false,
                borderColor: 'rgba(59,130,246,1)', // Azul
                tension: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endsection
