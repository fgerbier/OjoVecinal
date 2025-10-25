<nav class="bg-white border-b border-gray-200 shadow-sm">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">

    <!-- Logo -->
   <a href="{{ url('/') }}" class="flex items-center">
  <img src="{{ asset('storage/logo-ojovecinal.png') }}" class="max-h-20 h-auto" alt="Logo Ojo Vecinal" />
</a>
    <!-- Botón menú móvil -->
    <button data-collapse-toggle="mobile-menu" type="button"
      class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-700 rounded-lg md:hidden hover:bg-gray-100"
      aria-controls="mobile-menu" aria-expanded="false">
      <span class="sr-only">Abrir menú</span>
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>

    <!-- Perfil / login -->
    <div class="flex items-center md:order-2 space-x-3 md:space-x-0">
      @auth
        <button type="button" class="flex text-sm bg-gray-100 rounded-full focus:ring-2 focus:ring-blue-300"
          id="user-menu-button" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom-end">
          <span class="sr-only">Abrir menú de usuario</span>
          <img class="rounded-full w-9 h-9"
            src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=1d4ed8&color=fff"
            alt="Foto de perfil">
        </button>

        <!-- Dropdown -->
        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow"
          id="user-dropdown">
          <div class="px-4 py-3">
            <span class="block text-sm text-gray-900">{{ Auth::user()->name }}</span>
            <span class="block text-sm text-gray-500 truncate">{{ Auth::user()->email }}</span>
          </div>
          <ul class="py-2" aria-labelledby="user-menu-button">
            @if(Auth::user()->is_admin)
    <li>
      <a href="{{ route('dashboard') }}"
        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
        Dashboard
      </a>
    </li>
  @endif
            <li><a href="{{ route('profile.edit') }}"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Configuración</a></li>
            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                  class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Cerrar sesión</button>
              </form>
            </li>
          </ul>
        </div>
      @else
        <a href="{{ route('login') }}"
          class="text-sm bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg px-4 py-2">
          Iniciar sesión
        </a>
      @endauth
    </div>

    <!-- Menú principal -->
    <div class="hidden w-full md:flex md:w-auto" id="mobile-menu">
      <ul
        class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-white md:flex-row md:space-x-8 md:mt-0 md:border-0">
        <li>
          <a href="{{ route('reportes.comunidad') }}"
            class="block py-2 px-3 text-gray-800 rounded hover:bg-gray-100 md:hover:bg-transparent md:p-0">
            Reportes
          </a>
        </li>
        {{-- Agrega aquí más enlaces si lo necesitas --}}
      </ul>
    </div>
  </div>
</nav>
