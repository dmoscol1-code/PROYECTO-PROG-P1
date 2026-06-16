<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('libros.index') }}"
               class="text-gray-400 hover:text-red-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-gray-900 leading-tight">
                    {{ __('Editar Libro') }}
                </h2>
                <p class="text-sm text-gray-500 mt-0.5">
                    Modificando: <span class="font-medium text-gray-700">{{ $libro->titulo }}</span>
                </p>
            </div>
        </div>
    </x-slot>
 
    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('libros.update', $libro->id) }}" method="POST">
                @csrf
                @method('PUT')
 
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 px-5 py-5 mb-8">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                        <div id="step-indicator-1" class="flex items-center gap-2">
                            <span class="w-7 h-7 rounded-full bg-red-600 text-white text-xs font-bold flex items-center justify-center">1</span>
                            <span class="text-sm font-semibold text-red-600">Información Principal</span>
                        </div>
                        <div class="flex-1 h-px bg-gray-300"></div>
                        <div id="step-indicator-2" class="flex items-center gap-2">
                            <span id="step2-circle" class="w-7 h-7 rounded-full bg-gray-300 text-gray-500 text-xs font-bold flex items-center justify-center">2</span>
                            <span id="step2-label" class="text-sm font-semibold text-gray-400">Datos Técnicos</span>
                        </div>
                    </div>
                </div>

                <div id="step-1">
                {{-- Información principal --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-5">
                    <div class="bg-red-600 px-6 py-3">
                        <h3 class="text-white font-semibold text-sm uppercase tracking-wider flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Información Principal
                        </h3>
                    </div>
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">
 
                        {{-- Título --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5" for="titulo">
                                Título <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="titulo" id="titulo"
                                   placeholder="Ej: Cien años de soledad"
                                   class="w-full border {{ $errors->has('titulo') ? 'border-red-400 bg-red-50' : 'border-gray-300' }} rounded-lg px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition"
                                   value="{{ old('titulo', $libro->titulo) }}" required>
                            @error('titulo')
                                <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                    <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
 
                        {{-- Autor --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5" for="autor">
                                Autor <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="autor" id="autor"
                                   placeholder="Ej: Gabriel García Márquez"
                                   class="w-full border {{ $errors->has('autor') ? 'border-red-400 bg-red-50' : 'border-gray-300' }} rounded-lg px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition"
                                   value="{{ old('autor', $libro->autor) }}" required>
                            @error('autor')
                                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>
 
                        {{-- Editorial --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5" for="editorial">
                                Editorial
                            </label>
                            <input type="text" name="editorial" id="editorial"
                                   placeholder="Ej: Sudamericana"
                                   class="w-full border {{ $errors->has('editorial') ? 'border-red-400 bg-red-50' : 'border-gray-300' }} rounded-lg px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition"
                                   value="{{ old('editorial', $libro->editorial) }}">
                            @error('editorial')
                                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>
 
                        {{-- Categoría --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5" for="categoria">
                                Categoría
                            </label>
                            <select name="categoria" id="categoria"
                                    class="w-full border {{ $errors->has('categoria') ? 'border-red-400 bg-red-50' : 'border-gray-300' }} rounded-lg px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition">
                                <option value="">— Seleccionar —</option>
                                <option value="ficcion"     {{ old('categoria', $libro->categoria) == 'ficcion'     ? 'selected' : '' }}>Ficción</option>
                                <option value="no_ficcion"  {{ old('categoria', $libro->categoria) == 'no_ficcion'  ? 'selected' : '' }}>No Ficción</option>
                                <option value="ciencia"     {{ old('categoria', $libro->categoria) == 'ciencia'     ? 'selected' : '' }}>Ciencia</option>
                                <option value="historia"    {{ old('categoria', $libro->categoria) == 'historia'    ? 'selected' : '' }}>Historia</option>
                                <option value="tecnologia"  {{ old('categoria', $libro->categoria) == 'tecnologia'  ? 'selected' : '' }}>Tecnología</option>
                                <option value="arte"        {{ old('categoria', $libro->categoria) == 'arte'        ? 'selected' : '' }}>Arte</option>
                                <option value="infantil"    {{ old('categoria', $libro->categoria) == 'infantil'    ? 'selected' : '' }}>Infantil</option>
                                <option value="autoayuda"   {{ old('categoria', $libro->categoria) == 'autoayuda'   ? 'selected' : '' }}>Autoayuda</option>
                                <option value="derecho"     {{ old('categoria', $libro->categoria) == 'derecho'     ? 'selected' : '' }}>Derecho</option>
                                <option value="medicina"    {{ old('categoria', $libro->categoria) == 'medicina'    ? 'selected' : '' }}>Medicina</option>
                            </select>
                            @error('categoria')
                                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>
 
                        {{-- Año de publicación --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5" for="anio_publicacion">
                                Año de publicación
                            </label>
                            <input type="number" name="anio_publicacion" id="anio_publicacion"
                                   placeholder="Ej: 1967"
                                   min="1000" max="{{ date('Y') }}"
                                   class="w-full border {{ $errors->has('anio_publicacion') ? 'border-red-400 bg-red-50' : 'border-gray-300' }} rounded-lg px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition"
                                   value="{{ old('anio_publicacion', $libro->anio_publicacion) }}">
                            @error('anio_publicacion')
                                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>
 
                        {{-- Descripción --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5" for="descripcion">
                                Descripción / Sinopsis
                            </label>
                            <textarea name="descripcion" id="descripcion" rows="4"
                                      placeholder="Breve descripción o sinopsis del libro..."
                                      class="w-full border {{ $errors->has('descripcion') ? 'border-red-400 bg-red-50' : 'border-gray-300' }} rounded-lg px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition resize-none">{{ old('descripcion', $libro->descripcion) }}</textarea>
                            @error('descripcion')
                                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>
 
                    </div>
                </div>

                    <div class="flex justify-end">
                        <button type="button" onclick="goToStep2()" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-semibold py-2.5 px-6 rounded-lg shadow transition-colors">
                            Siguiente
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>
                </div>
 
                <div id="step-2" class="hidden">
                    {{-- Datos técnicos e inventario --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
                    <div class="bg-red-600 px-6 py-3">
                        <h3 class="text-white font-semibold text-sm uppercase tracking-wider flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            Datos Técnicos e Inventario
                        </h3>
                    </div>
                    <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-5">
 
                        {{-- ISBN --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5" for="isbn">
                                ISBN
                            </label>
                            <input type="text" name="isbn" id="isbn"
                                   placeholder="978-XXXXXXXXXX"
                                   class="w-full border {{ $errors->has('isbn') ? 'border-red-400 bg-red-50' : 'border-gray-300' }} rounded-lg px-4 py-2.5 text-sm font-mono text-gray-900 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition"
                                   value="{{ old('isbn', $libro->isbn) }}">
                            @error('isbn')
                                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>
 
                        {{-- Número de páginas --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5" for="paginas">
                                Número de páginas
                            </label>
                            <input type="number" name="paginas" id="paginas"
                                   placeholder="Ej: 432"
                                   min="1"
                                   class="w-full border {{ $errors->has('paginas') ? 'border-red-400 bg-red-50' : 'border-gray-300' }} rounded-lg px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition"
                                   value="{{ old('paginas', $libro->paginas) }}">
                            @error('paginas')
                                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>
 
                        {{-- Idioma --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5" for="idioma">
                                Idioma
                            </label>
                            <select name="idioma" id="idioma"
                                    class="w-full border {{ $errors->has('idioma') ? 'border-red-400 bg-red-50' : 'border-gray-300' }} rounded-lg px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition">
                                <option value="espanol"   {{ old('idioma', $libro->idioma) == 'espanol'   ? 'selected' : '' }}>Español</option>
                                <option value="ingles"    {{ old('idioma', $libro->idioma) == 'ingles'    ? 'selected' : '' }}>Inglés</option>
                                <option value="frances"   {{ old('idioma', $libro->idioma) == 'frances'   ? 'selected' : '' }}>Francés</option>
                                <option value="aleman"    {{ old('idioma', $libro->idioma) == 'aleman'    ? 'selected' : '' }}>Alemán</option>
                                <option value="portugues" {{ old('idioma', $libro->idioma) == 'portugues' ? 'selected' : '' }}>Portugués</option>
                                <option value="otro"      {{ old('idioma', $libro->idioma) == 'otro'      ? 'selected' : '' }}>Otro</option>
                            </select>
                            @error('idioma')
                                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>
 
                        {{-- Inventario --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5" for="inventario">
                                Cantidad en inventario <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="inventario" id="inventario"
                                   placeholder="0"
                                   min="0"
                                   class="w-full border {{ $errors->has('inventario') ? 'border-red-400 bg-red-50' : 'border-gray-300' }} rounded-lg px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition"
                                   value="{{ old('inventario', $libro->inventario) }}" required>
                            @error('inventario')
                                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>
 
                        {{-- Precio --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5" for="precio">
                                Precio (USD)
                            </label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm font-semibold">$</span>
                                <input type="number" name="precio" id="precio"
                                       placeholder="0.00"
                                       min="0" step="0.01"
                                       class="w-full border {{ $errors->has('precio') ? 'border-red-400 bg-red-50' : 'border-gray-300' }} rounded-lg pl-8 pr-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition"
                                       value="{{ old('precio', $libro->precio) }}">
                            </div>
                            @error('precio')
                                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>
 
                        {{-- Edición --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5" for="edicion">
                                Edición
                            </label>
                            <input type="text" name="edicion" id="edicion"
                                   placeholder="Ej: 3ª edición"
                                   class="w-full border {{ $errors->has('edicion') ? 'border-red-400 bg-red-50' : 'border-gray-300' }} rounded-lg px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition"
                                   value="{{ old('edicion', $libro->edicion) }}">
                            @error('edicion')
                                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>
 
                    </div>
                </div>

                    <div class="mt-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <button type="button" onclick="goToStep1()" class="w-full sm:w-auto bg-white hover:bg-gray-50 border border-gray-300 text-gray-700 font-semibold py-2.5 px-4 rounded-lg transition">Atrás</button>
                        <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                            <a href="{{ route('libros.index') }}" class="w-full sm:w-auto bg-white hover:bg-gray-50 border border-gray-300 text-gray-700 font-semibold py-2.5 px-4 rounded-lg transition">Cancelar</a>
                            <button type="submit" class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white font-semibold py-2.5 px-6 rounded-lg shadow transition-colors">Actualizar Libro</button>
                        </div>
                    </div>
                </div>
 
                {{-- Última modificación --}}
                <div class="flex items-center gap-2 text-xs text-gray-400 mb-5 px-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Última modificación: {{ $libro->updated_at->format('d/m/Y H:i') }}
                </div>
 
                <script>
                    function goToStep2() {
                        const titulo = document.getElementById('titulo');
                        const autor = document.getElementById('autor');
                        if (!titulo.value.trim() || !autor.value.trim()) {
                            titulo.reportValidity();
                            return;
                        }
                        document.getElementById('step-1').classList.add('hidden');
                        document.getElementById('step-2').classList.remove('hidden');
                        document.getElementById('step2-circle').classList.replace('bg-gray-300', 'bg-red-600');
                        document.getElementById('step2-circle').classList.replace('text-gray-500', 'text-white');
                        document.getElementById('step2-label').classList.replace('text-gray-400', 'text-red-600');
                    }

                    function goToStep1() {
                        document.getElementById('step-2').classList.add('hidden');
                        document.getElementById('step-1').classList.remove('hidden');
                        document.getElementById('step2-circle').classList.replace('bg-red-600', 'bg-gray-300');
                        document.getElementById('step2-circle').classList.replace('text-white', 'text-gray-500');
                        document.getElementById('step2-label').classList.replace('text-red-600', 'text-gray-400');
                    }

                    @if ($errors->hasAny(['isbn', 'paginas', 'idioma', 'inventario', 'precio', 'edicion']))
                        goToStep2();
                    @endif
                </script>
            </form>

            <div class="mt-5">
                <form action="{{ route('libros.destroy', $libro->id) }}" method="POST"
                      onsubmit="return confirm('¿Eliminar «{{ addslashes($libro->titulo) }}»? Esta acción no se puede deshacer.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center gap-2 text-red-600 hover:text-red-800 hover:bg-red-50 border border-red-200 font-semibold py-2.5 px-5 rounded-lg transition-colors text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Eliminar libro
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>