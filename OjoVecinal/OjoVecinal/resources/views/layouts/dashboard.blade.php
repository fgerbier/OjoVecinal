<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Tipografía moderna -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Flowbite -->
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
</head>
<body class="bg-gray-100 font-['Roboto']">

    <div class="flex">
        <!-- Sidebar -->
<aside class="w-64 h-screen bg-white shadow-md">
    <div class="p-6 border-b border-gray-200 text-center">
        <img src="{{ asset('storage/logo-ojovecinal.png') }}" alt="Logo Ojo Vecinal" class="w-20 h-auto mx-auto mb-2">
        <div class="text-xl font-bold text-gray-700">Ojo Vecinal</div>
    </div>
    <nav class="p-4 space-y-2">
        <a href="{{ url('/') }}"
           class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 rounded {{ request()->is('/') ? 'bg-gray-100 font-semibold' : '' }}">
            <span class="ml-2">Home</span>
        </a>
    <a href="{{ route('dashboard') }}"
       class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 rounded {{ request()->routeIs('dashboard') ? 'bg-gray-100 font-semibold' : '' }}">
        <span class="ml-2">Dashboard</span>
    </a>
    <a href="{{ route('dashboard.reports.index') }}"
       class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 rounded {{ request()->routeIs('dashboard.reports.*') ? 'bg-gray-100 font-semibold' : '' }}">
        <span class="ml-2">Reportes</span>
    </a>
    <a href="{{ route('dashboard.comments.index') }}"
       class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 rounded {{ request()->routeIs('dashboard.comments.index') ? 'bg-gray-100 font-semibold' : '' }}">
        <span class="ml-2">Comentarios</span>
    </a>
</nav>

        
</aside>


        <!-- Contenido principal -->
        <div class="flex-1 flex flex-col">
            <!-- Topbar -->
            <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
                <h1 class="text-xl font-semibold text-gray-800">@yield('title', 'Panel de Administración')</h1>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">Hola, {{ Auth::user()->name ?? 'Usuario' }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-red-600 hover:underline">Salir</button>
                    </form>
                </div>
            </header>

            <!-- Contenido dinámico -->
            <main class="p-6 overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
