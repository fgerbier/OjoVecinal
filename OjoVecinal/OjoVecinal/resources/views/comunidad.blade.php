@extends('layouts.app')

@section('content')
<div class="bg-blue-100 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-2xl font-semibold mb-6 text-gray-800">Reportes de la comunidad</h1>

        <div class="overflow-x-auto">
            <div class="grid grid-cols-4 gap-6 min-w-[1024px]">
                @foreach ($reportes as $reporte)
                    <div class="bg-white rounded-lg shadow-md p-4 border border-gray-200 text-sm flex flex-col justify-between h-full">
                        <div>
                            <h2 class="text-base font-semibold text-blue-800 mb-1">{{ $reporte->titulo }}</h2>

                            <!-- Estado -->
                            <span class="inline-block text-xs font-medium px-2 py-1 rounded mb-2
                                @if($reporte->estado === 'pendiente') bg-yellow-100 text-yellow-700
                                @elseif($reporte->estado === 'en_proceso') bg-blue-100 text-blue-700
                                @elseif($reporte->estado === 'resuelto') bg-green-100 text-green-700
                                @elseif($reporte->estado === 'descartado') bg-red-100 text-red-700
                                @endif">
                                Estado: {{ ucfirst(str_replace('_', ' ', $reporte->estado)) }}
                            </span>

                            <!-- Fecha y ubicación -->
                            <p class="text-xs text-gray-600 mb-1">
                                <strong>Fecha:</strong> {{ \Carbon\Carbon::parse($reporte->fecha_incidente)->format('d/m/Y H:i') }}
                            </p>
                            @if($reporte->ubicacion_aproximada)
                                <p class="text-xs text-gray-600 mb-2">
                                    <strong>Ubicación:</strong> {{ $reporte->ubicacion_aproximada }}
                                </p>
                            @endif

                            <p class="mb-2 text-gray-700">{{ $reporte->descripcion }}</p>

                            @if($reporte->foto)
                                <img src="{{ asset('storage/' . $reporte->foto) }}" class="w-full rounded mb-3">
                            @endif

                            <div class="mb-2">
                                <button onclick="openModal({{ $reporte->id }})" class="text-sm text-blue-600 hover:underline">
                                    Ver comentarios ({{ $reporte->comments->count() }})
                                </button>
                            </div>
                        </div>

                        <!-- Formulario de comentario -->
                        <form method="POST" action="{{ route('reportes.comentar', $reporte) }}" class="space-y-2 mt-2">
                            @csrf
                            <input type="text" name="nombre" placeholder="Tu nombre (opcional)" class="w-full border rounded px-2 py-1 text-xs">
                            <textarea name="contenido" required placeholder="Escribe tu comentario..." class="w-full border rounded px-2 py-1 text-xs" rows="2"></textarea>
                            <button type="submit" class="bg-blue-600 text-white px-3 py-1.5 rounded hover:bg-blue-700 text-xs">
                                Publicar
                            </button>
                        </form>
                    </div>

                    <!-- Modal de comentarios -->
                    <div id="modal-{{ $reporte->id }}" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
                        <div class="bg-white rounded-lg p-6 w-full max-w-lg relative">
                            <button onclick="closeModal({{ $reporte->id }})" class="absolute top-2 right-3 text-gray-500 hover:text-red-600 text-xl">
                                &times;
                            </button>
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Comentarios de "{{ $reporte->titulo }}"</h3>

                            <div class="space-y-2 max-h-96 overflow-y-auto pr-2">
                                @forelse ($reporte->comments as $comment)
                                    <div class="bg-gray-100 rounded px-3 py-2">
                                        <p class="text-sm text-gray-800">{{ $comment->contenido }}</p>
                                        <p class="text-xs text-gray-500 mt-1">— {{ $comment->nombre ?? 'Anónimo' }}, {{ $comment->created_at->diffForHumans() }}</p>
                                    </div>
                                @empty
                                    <p class="text-sm text-gray-500">No hay comentarios aún.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
    function openModal(id) {
        const modal = document.getElementById('modal-' + id);
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModal(id) {
        const modal = document.getElementById('modal-' + id);
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endsection
