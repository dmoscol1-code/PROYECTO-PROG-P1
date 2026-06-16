<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-red-900 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-red-200">
                <div class="p-6 text-gray-900">
                    <p class="mb-2">Bienvenido — esto es el panel por defecto.</p>
                    <p class="mb-2">Accede a las secciones:</p>
                    <ul class="list-disc ms-6 text-gray-700">
                        <li><a href="{{ route('prestamos.index') }}" class="text-red-600 hover:text-red-800 hover:underline">Préstamos</a></li>
                        <li><a href="{{ route('libros.index') }}" class="text-red-600 hover:text-red-800 hover:underline">Libros</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
