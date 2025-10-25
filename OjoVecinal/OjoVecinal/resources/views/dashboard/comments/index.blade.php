@extends('layouts.dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <h1 class="text-2xl font-semibold text-gray-700 mb-6">Comentarios de la comunidad</h1>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-medium">Reporte</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Nombre</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Comentario</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Fecha</th>
                    <th class="px-4 py-2 text-center text-sm font-medium">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-sm">
                @forelse ($comentarios as $comentario)
                <tr>
                    <td class="px-4 py-2 text-blue-700">{{ $comentario->report->titulo ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $comentario->nombre ?? 'Anónimo' }}</td>
                    <td class="px-4 py-2">{{ $comentario->contenido }}</td>
                    <td class="px-4 py-2 text-gray-500">{{ $comentario->created_at->format('d/m/Y H:i') }}</td>
                    <td class="px-4 py-2 text-center">
                        <form method="POST" action="{{ route('dashboard.comments.destroy', $comentario->id) }}" onsubmit="return confirm('¿Deseas eliminar este comentario?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline font-semibold text-sm">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-gray-500">No hay comentarios registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $comentarios->links() }}
    </div>
</div>
@endsection
