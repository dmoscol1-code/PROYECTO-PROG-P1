<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 leading-tight">
                    📚 {{ __('UEEStanteria') }}
                </h2>
                <p class="text-sm text-white mt-0.5">Gestiona el inventario de tu biblioteca</p>
            </div>
            <a href="{{ route('libros.create') }}"
               class="inline-flex items-center gap-2 bg-white hover:bg-gray-100 active:bg-gray-200 text-red-600 font-semibold py-2.5 px-5 rounded-lg shadow transition-colors duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                {{ __('Nuevo Libro') }}
            </a>
        </div>
    </x-slot>
 
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
 
            {{-- Mensaje flash --}}
            @if (session('success'))
                <div class="flex items-center gap-3 bg-green-50 border border-green-300 text-green-800 px-5 py-3.5 rounded-lg shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
            @endif
 
            {{-- Filtros rápidos --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 px-6 py-4 mt-4">
                <form method="GET" action="{{ route('libros.index') }}" class="flex flex-wrap gap-3 items-end">
                    <div class="flex-1 min-w-[180px]">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Buscar</label>
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Título, autor, ISBN..."
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent">
                    </div>
                    <div class="min-w-[150px]">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Categoría</label>
                        <select name="categoria" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400">
                            <option value="">Todas</option>
                            <option value="ficcion" {{ request('categoria') == 'ficcion' ? 'selected' : '' }}>Ficción</option>
                            <option value="no_ficcion" {{ request('categoria') == 'no_ficcion' ? 'selected' : '' }}>No Ficción</option>
                            <option value="ciencia" {{ request('categoria') == 'ciencia' ? 'selected' : '' }}>Ciencia</option>
                            <option value="historia" {{ request('categoria') == 'historia' ? 'selected' : '' }}>Historia</option>
                            <option value="tecnologia" {{ request('categoria') == 'tecnologia' ? 'selected' : '' }}>Tecnología</option>
                            <option value="arte" {{ request('categoria') == 'arte' ? 'selected' : '' }}>Arte</option>
                            <option value="infantil" {{ request('categoria') == 'infantil' ? 'selected' : '' }}>Infantil</option>
                        </select>
                    </div>
                    <div class="min-w-[130px]">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Disponibilidad</label>
                        <select name="disponible" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400">
                            <option value="">Todos</option>
                            <option value="1" {{ request('disponible') == '1' ? 'selected' : '' }}>Disponible</option>
                            <option value="0" {{ request('disponible') == '0' ? 'selected' : '' }}>Sin stock</option>
                        </select>
                    </div>
                    <div class="flex gap-2 items-end">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1 invisible">Acción</label>
                            <button type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition-colors">
                                Filtrar
                            </button>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1 invisible">Acción</label>
                            <a href="{{ route('libros.index') }}"
                               class="block bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold px-4 py-2 rounded-lg transition-colors text-center">
                                Limpiar
                            </a>
                        </div>
                    </div>
                </form>
            </div>
 
            {{-- Tabla --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
 
                @if ($libros->count())
 
                    {{-- Estadísticas rápidas --}}
                    <div class="flex divide-x divide-gray-100 border-b border-gray-200">
                        <div class="px-6 py-3 flex items-center gap-3">
                            <p class="text-xl font-bold text-gray-900">{{ $libros->total() }}</p>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Total libros</p>
                        </div>
                        <div class="px-6 py-3 flex items-center gap-3">
                            <p class="text-xl font-bold text-green-600">{{ $libros->where('inventario', '>', 0)->count() }}</p>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Disponibles</p>
                        </div>
                        <div class="px-6 py-3 flex items-center gap-3">
                            <p class="text-xl font-bold text-red-500">{{ $libros->where('inventario', '<=', 0)->count() }}</p>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Sin stock</p>
                        </div>
                    </div>
 
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr class="bg-gray-50 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    <th class="px-5 py-3">Título</th>
                                    <th class="px-5 py-3">Autor</th>
                                    <th class="px-5 py-3">Editorial</th>
                                    <th class="px-5 py-3">Categoría</th>
                                    <th class="px-5 py-3">Año</th>
                                    <th class="px-5 py-3 text-center">Inventario</th>
                                    <th class="px-5 py-3 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($libros as $libro)
                                    <tr class="hover:bg-red-50 transition-colors duration-100 group">
                                        <td class="px-5 py-4">
                                            <p class="font-semibold text-gray-900 group-hover:text-red-700 transition-colors">{{ $libro->titulo }}</p>
                                        </td>
                                        <td class="px-5 py-4 text-sm text-gray-700">{{ $libro->autor }}</td>
                                        <td class="px-5 py-4 text-sm text-gray-700">{{ $libro->editorial ?? '—' }}</td>
                                        <td class="px-5 py-4">
                                            @if ($libro->categoria)
                                                <span class="inline-block bg-red-100 text-red-700 text-xs font-semibold px-2.5 py-1 rounded-full">
                                                    {{ ucfirst($libro->categoria) }}
                                                </span>
                                            @else
                                                <span class="text-gray-400 text-sm">—</span>
                                            @endif
                                        </td>
                                        <td class="px-5 py-4 text-sm text-gray-700">{{ $libro->anio_publicacion ?? '—' }}</td>
                                        <td class="px-5 py-4 text-center">
                                            @if ($libro->inventario > 0)
                                                <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 text-xs font-bold px-2.5 py-1 rounded-full">
                                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                                                    {{ $libro->inventario }}
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1 bg-red-100 text-red-600 text-xs font-bold px-2.5 py-1 rounded-full">
                                                    <span class="w-1.5 h-1.5 bg-red-400 rounded-full"></span>
                                                    Sin stock
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-5 py-4">
                                            <div class="flex justify-center gap-2">
                                                @if ($libro->inventario > 0)
                                                    <a href="{{ route('prestamos.create', ['libro' => $libro->id]) }}"
                                                       class="inline-flex items-center gap-1 text-sm text-white hover:text-white font-medium bg-red-600 hover:bg-red-700 px-3 py-1.5 rounded-lg transition-colors">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M6 11h12M4 15h16M7 19h10"/>
                                                        </svg>
                                                        Prestar
                                                    </a>
                                                @else
                                                    <span
                                                        class="inline-flex items-center gap-1 text-sm text-gray-400 bg-gray-100 border border-gray-200 px-3 py-1.5 rounded-lg opacity-60 cursor-not-allowed"
                                                        aria-disabled="true">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M6 11h12M4 15h16M7 19h10"/>
                                                        </svg>
                                                        Sin stock
                                                    </span>
                                                @endif
                                                <a href="{{ route('libros.edit', $libro->id) }}"
                                                   class="inline-flex items-center gap-1 text-sm text-blue-600 hover:text-blue-800 font-medium bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-lg transition-colors">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                    Editar
                                                </a>
                                                <form action="{{ route('libros.destroy', $libro->id) }}" method="POST" class="inline-block"
                                                      onsubmit="return confirm('¿Eliminar «{{ addslashes($libro->titulo) }}»? Esta acción no se puede deshacer.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="inline-flex items-center gap-1 text-sm text-red-600 hover:text-red-800 font-medium bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg transition-colors">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                        Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
 
                    {{-- Paginación --}}
                    @if ($libros->hasPages())
                        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                            {{ $libros->links() }}
                        </div>
                    @endif
 
                @else
                    {{-- Estado vacío --}}
                    <div class="flex flex-col items-center justify-center py-20 text-center px-6">
                        <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mb-5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 mb-1">No hay libros registrados</h3>
                        <p class="text-sm text-gray-500 mb-6 max-w-xs">Comienza agregando el primer libro al catálogo.</p>
                        <a href="{{ route('libros.create') }}"
                           class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-semibold py-2.5 px-6 rounded-lg shadow transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Agregar primer libro
                        </a>
                    </div>
                @endif
            </div>
 
        </div>
    </div>
</x-app-layout>