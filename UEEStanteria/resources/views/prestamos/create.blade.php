<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-semibold text-gray-900 leading-tight">{{ __('Nuevo préstamo') }}</h2>
                <p class="text-sm text-gray-600 mt-1">Crear un préstamo de libro desde el catálogo.</p>
            </div>

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6 text-gray-900">
                    @if ($libros->isEmpty() && !$selectedLibro)
                        <div class="rounded-xl border border-gray-200 bg-gray-50 p-6 text-center">
                            <p class="text-lg font-semibold text-gray-900">No hay libros disponibles</p>
                            <p class="mt-2 text-sm text-gray-600">Agrega primero un libro para poder crear un préstamo.</p>
                            <a href="{{ route('libros.index') }}" class="mt-4 inline-flex items-center justify-center rounded-lg bg-red-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-red-700">
                                {{ __('Ir a libros') }}
                            </a>
                        </div>
                    @else
                        <form action="{{ route('prestamos.store') }}" method="POST">
                            @csrf

                            @if ($selectedLibro)
                                <div class="mb-6 rounded-lg border border-gray-200 bg-gray-50 p-4">
                                    <p class="font-semibold text-gray-900">{{ __('Libro seleccionado') }}</p>
                                    <p class="text-sm text-gray-700">{{ $selectedLibro->titulo }} @if($selectedLibro->autor) - {{ $selectedLibro->autor }} @endif</p>
                                    <input type="hidden" name="libro_id" value="{{ $selectedLibro->id }}">
                                </div>
                            @else
                                <div class="mb-6">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="libro_id">{{ __('Libro') }}</label>
                                    <select id="libro_id" name="libro_id" required
                                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-700 focus:border-red-400 focus:outline-none focus:ring-2 focus:ring-red-200 @error('libro_id') border-red-500 @enderror">
                                        <option value="">{{ __('Selecciona un libro') }}</option>
                                        @foreach ($libros as $libro)
                                            <option value="{{ $libro->id }}" {{ old('libro_id', optional($selectedLibro)->id) == $libro->id ? 'selected' : '' }}>
                                                {{ $libro->titulo }} @if($libro->autor) - {{ $libro->autor }} @endif
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('libro_id')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>
                            @endif

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="prestado_a">{{ __('Prestado a') }}</label>
                                <input type="text" id="prestado_a" name="prestado_a" value="{{ old('prestado_a') }}" required
                                       class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-700 focus:border-red-400 focus:outline-none focus:ring-2 focus:ring-red-200 @error('prestado_a') border-red-500 @enderror">
                                @error('prestado_a')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid gap-4 md:grid-cols-2">
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="fecha_prestamo">{{ __('Fecha de préstamo') }}</label>
                                    <input type="date" id="fecha_prestamo" name="fecha_prestamo" value="{{ old('fecha_prestamo', now()->format('Y-m-d')) }}" required
                                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-700 focus:border-red-400 focus:outline-none focus:ring-2 focus:ring-red-200 @error('fecha_prestamo') border-red-500 @enderror">
                                    @error('fecha_prestamo')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="fecha_devolucion">{{ __('Fecha de devolución') }}</label>
                                    <input type="date" id="fecha_devolucion" name="fecha_devolucion" value="{{ old('fecha_devolucion') }}"
                                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-700 focus:border-red-400 focus:outline-none focus:ring-2 focus:ring-red-200 @error('fecha_devolucion') border-red-500 @enderror">
                                    @error('fecha_devolucion')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="flex flex-wrap gap-3 mt-6">
                                <button type="submit" class="inline-flex items-center justify-center rounded-lg bg-red-600 px-6 py-2.5 text-sm font-semibold text-white hover:bg-red-700 transition-colors">
                                    {{ __('Guardar préstamo') }}
                                </button>
                                <a href="{{ route('prestamos.index') }}" class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-6 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-colors">
                                    {{ __('Cancelar') }}
                                </a>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
