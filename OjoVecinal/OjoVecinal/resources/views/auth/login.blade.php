@extends('layouts.guest')

@section('title', 'Iniciar sesión')

@section('content')
<div class="w-full max-w-md bg-white rounded-lg shadow-md p-8 space-y-6">
    <div class="text-center">
        <img src="{{ asset('storage/logo-ojovecinal.png') }}" alt="Logo Ojo Vecinal" class="w-24 mx-auto mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Iniciar sesión</h1>
        <p class="text-sm text-gray-500">Ingresa a tu cuenta de Ojo Vecinal</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email -->
        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Correo</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5">
            @error('email')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Contraseña -->
        <div>
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Contraseña</label>
            <input id="password" name="password" type="password" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5">
            @error('password')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Recordarme -->
        <div class="flex items-center justify-between">
            <label class="flex items-center space-x-2 text-sm text-gray-600">
                <input type="checkbox" name="remember" class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500">
                <span>Recordarme</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-green-700 hover:underline" href="{{ route('password.request') }}">
                    ¿Olvidaste tu contraseña?
                </a>
            @endif
        </div>

        <!-- Botón -->
        <div>
            <button type="submit"
                class="w-full text-white bg-green-700 hover:bg-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                Iniciar sesión
            </button>
        </div>

        <p class="text-sm text-center text-gray-500">
            ¿No tienes cuenta?
            <a href="{{ route('register') }}" class="text-green-700 hover:underline">Regístrate</a>
        </p>
    </form>
</div>
@endsection
