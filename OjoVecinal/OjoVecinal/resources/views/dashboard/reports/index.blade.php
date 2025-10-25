@extends('layouts.dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <h1 class="text-2xl font-semibold text-gray-700 mb-6">Reportes de incidentes</h1>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Filtro por fechas -->
    <form method="GET" action="{{ route('dashboard.reports.index') }}" class="mb-6 flex flex-wrap gap-4 items-end">
        <div>
            <label for="desde" class="block text-sm font-medium text-gray-700">Desde</label>
            <input type="date" name="desde" id="desde" value="{{ request('desde') }}"
                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring focus:ring-blue-200" />
        </div>
        <div>
            <label for="hasta" class="block text-sm font-medium text-gray-700">Hasta</label>
            <input type="date" name="hasta" id="hasta" value="{{ request('hasta') }}"
                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring focus:ring-blue-200" />
        </div>
        <div>
            <button type="submit"
                class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded-lg mt-1">
                Filtrar
            </button>
        </div>
    </form>

    <!-- Tabla -->
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-medium">Título</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Categoría</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Fecha</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Reportado por</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Estado</th>
                    <th class="px-4 py-2 text-center text-sm font-medium">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-sm">
                @forelse ($reportes as $reporte)
                <tr>
                    <td class="px-4 py-2">{{ $reporte->titulo }}</td>
                    <td class="px-4 py-2">{{ $reporte->categorias }}</td>
                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($reporte->fecha_incidente)->format('d/m/Y H:i') }}</td>
                    <td class="px-4 py-2">{{ $reporte->nombre ?? '-' }}</td>
                    <td class="px-4 py-2">
                        <form method="POST" action="{{ route('dashboard.reports.cambiarEstado', $reporte->id) }}">
                            @csrf
                            @method('PUT')
                            <select name="estado" onchange="this.form.submit()"
                                class="w-40 px-3 py-1.5 border border-gray-300 rounded-lg text-sm shadow-sm focus:ring focus:ring-blue-200">
                                <option value="pendiente" {{ $reporte->estado === 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="en_proceso" {{ $reporte->estado === 'en_proceso' ? 'selected' : '' }}>En proceso</option>
                                <option value="resuelto" {{ $reporte->estado === 'resuelto' ? 'selected' : '' }}>Resuelto</option>
                                <option value="descartado" {{ $reporte->estado === 'descartado' ? 'selected' : '' }}>Descartado</option>
                            </select>
                        </form>

                    </td>
                    <td class="px-4 py-2 text-center">
                        <button onclick="openModal({{ $reporte->id }})"
                                class="text-blue-600 hover:underline font-semibold">
                            Ver detalles
                        </button>
                    </td>
                </tr>

                <!-- Modal -->
                <div id="modal-{{ $reporte->id }}" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden justify-center items-center">
                    <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 relative">
                        <button onclick="closeModal({{ $reporte->id }})" class="absolute top-2 right-3 text-gray-500 hover:text-red-600 text-lg">
                            &times;
                        </button>
                        <h2 class="text-xl font-semibold text-gray-700 mb-4">{{ $reporte->titulo }}</h2>

                        <p class="text-sm text-gray-600"><strong>Categoría:</strong> {{ $reporte->categorias }}</p>
                        <p class="text-sm text-gray-600"><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($reporte->fecha_incidente)->format('d/m/Y H:i') }}</p>
                        <p class="text-sm text-gray-600"><strong>Reportado por:</strong> {{ $reporte->nombre ?? '-' }}</p>
                        <p class="text-sm text-gray-600"><strong>Email:</strong> {{ $reporte->email ?? '-' }}</p>
                        <p class="text-sm text-gray-600 mt-2"><strong>Descripción:</strong></p>
                        <p class="text-gray-800">{{ $reporte->descripcion }}</p>

                        <p class="text-sm text-gray-600 mt-2"><strong>Ubicación:</strong> {{ $reporte->ubicacion_aproximada ?? '-' }}</p>

                        @if($reporte->foto)
                            <div class="mt-4">
                                <img src="{{ asset('storage/' . $reporte->foto) }}" alt="Foto del incidente" class="w-full rounded border" />
                            </div>
                        @endif
                    </div>
                </div>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-gray-500">No hay reportes registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $reportes->withQueryString()->links() }}
    </div>
</div>

<script>
    function openModal(id) {
        document.getElementById('modal-' + id).classList.remove('hidden');
        document.getElementById('modal-' + id).classList.add('flex');
    }

    function closeModal(id) {
        document.getElementById('modal-' + id).classList.remove('flex');
        document.getElementById('modal-' + id).classList.add('hidden');
    }
</script>
@endsection
