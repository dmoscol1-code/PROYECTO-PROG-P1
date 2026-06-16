<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-semibold text-gray-900 leading-tight">{{ __('Préstamos de libros') }}</h2>
                <p class="text-sm text-gray-600 mt-1">Aquí puedes ver todos los préstamos creados desde el catálogo de libros.</p>
            </div>

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 rounded-xl bg-green-50 border border-green-200 px-6 py-4 text-green-800 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6 text-gray-900">
                    @if ($prestamos->count())
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                        <th class="px-4 py-3">{{ __('Libro') }}</th>
                                        <th class="px-4 py-3">{{ __('Autor') }}</th>
                                        <th class="px-4 py-3">{{ __('Prestado a') }}</th>
                                        <th class="px-4 py-3">{{ __('Fecha de préstamo') }}</th>
                                        <th class="px-4 py-3">{{ __('Fecha de devolución') }}</th>
                                        <th class="px-4 py-3">{{ __('Acciones') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach ($prestamos as $prestamo)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-3 font-semibold text-gray-900">{{ $prestamo->libro->titulo }}</td>
                                            <td class="px-4 py-3 text-gray-700">{{ $prestamo->libro->autor ?? '—' }}</td>
                                            <td class="px-4 py-3 text-gray-700">{{ $prestamo->prestado_a }}</td>
                                            <td class="px-4 py-3 text-gray-700">{{ $prestamo->fecha_prestamo ? $prestamo->fecha_prestamo->format('Y-m-d') : '—' }}</td>
                                            <td class="px-4 py-3 text-gray-700">{{ $prestamo->fecha_devolucion ? $prestamo->fecha_devolucion->format('Y-m-d') : '—' }}</td>
                                            <td class="px-4 py-3">
                                                <form action="{{ route('prestamos.destroy', $prestamo->id) }}" method="POST" onsubmit="return confirm('¿Confirmar devolución del libro?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-green-600 px-3 py-2 text-sm font-semibold text-white hover:bg-green-700 transition-colors">
                                                        {{ __('Devolver') }}
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if ($prestamos->hasPages())
                            <div class="mt-6">
                                {{ $prestamos->links() }}
                            </div>
                        @endif
                    @else
                        <div class="rounded-xl border border-gray-200 bg-gray-50 p-8 text-center">
                            <p class="text-lg font-semibold text-gray-900">No hay préstamos registrados</p>
                            <p class="mt-2 text-sm text-gray-600">Crea un préstamo desde la lista de libros usando el botón "Prestar" junto a cada libro.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
