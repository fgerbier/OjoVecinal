@extends('layouts.guest')

@section('title', 'Registro')

@section('content')
<div class="w-full max-w-md bg-white rounded-lg shadow-md p-8 space-y-6">
    <div class="text-center">
        <img src="{{ asset('storage/logo-ojovecinal.png') }}" alt="Logo Ojo Vecinal" class="w-24 mx-auto mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Crear cuenta</h1>
        <p class="text-sm text-gray-500">Únete a Ojo Vecinal</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nombre</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5">
            @error('name')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Correo</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5">
            @error('email')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Contraseña</label>
            <input id="password" name="password" type="password" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5">
            @error('password')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">Confirmar contraseña</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5">
        </div>

        <div>
            <button type="submit"
                class="w-full text-white bg-green-700 hover:bg-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                Registrarse
            </button>
        </div>

        <p class="text-sm text-center text-gray-500">
            ¿Ya tienes una cuenta?
            <a href="{{ route('login') }}" class="text-green-700 hover:underline">Inicia sesión</a>
        </p>
    </form>
</div>
@endsection
