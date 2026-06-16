<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('libros.index') }}" class="text-sm text-white mt-0.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-gray-900 leading-tight">{{ __('Agregar Nuevo Libro') }}</h2>
                <p class="text-sm text-white mt-0.5">Completa los datos del libro para añadirlo al catálogo</p>
            </div>
        </div>
    </x-slot>
 
    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('libros.store') }}" method="POST">
                @csrf
 
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
 
                {{-- PASO 1: Información principal --}}
                <div id="step-1">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-5">
                            <div class="px-6 py-3 border-b border-gray-100">
                                <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wider">Información Principal</h3>
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
                                       value="{{ old('titulo') }}" required>
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
                                       value="{{ old('autor') }}" required>
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
                                       value="{{ old('editorial') }}">
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
                                    <option value="ficcion"     {{ old('categoria') == 'ficcion'     ? 'selected' : '' }}>Ficción</option>
                                    <option value="no_ficcion"  {{ old('categoria') == 'no_ficcion'  ? 'selected' : '' }}>No Ficción</option>
                                    <option value="ciencia"     {{ old('categoria') == 'ciencia'     ? 'selected' : '' }}>Ciencia</option>
                                    <option value="historia"    {{ old('categoria') == 'historia'    ? 'selected' : '' }}>Historia</option>
                                    <option value="tecnologia"  {{ old('categoria') == 'tecnologia'  ? 'selected' : '' }}>Tecnología</option>
                                    <option value="arte"        {{ old('categoria') == 'arte'        ? 'selected' : '' }}>Arte</option>
                                    <option value="infantil"    {{ old('categoria') == 'infantil'    ? 'selected' : '' }}>Infantil</option>
                                    <option value="autoayuda"   {{ old('categoria') == 'autoayuda'   ? 'selected' : '' }}>Autoayuda</option>
                                    <option value="derecho"     {{ old('categoria') == 'derecho'     ? 'selected' : '' }}>Derecho</option>
                                    <option value="medicina"    {{ old('categoria') == 'medicina'    ? 'selected' : '' }}>Medicina</option>
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
                                       value="{{ old('anio_publicacion') }}">
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
                                          class="w-full border {{ $errors->has('descripcion') ? 'border-red-400 bg-red-50' : 'border-gray-300' }} rounded-lg px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition resize-none">{{ old('descripcion') }}</textarea>
                                @error('descripcion')
                                    <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>
 
                        </div>
                    </div>
 
                    <div class="flex justify-end">
                            <button type="button" onclick="goToStep2()" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded-lg shadow transition-colors">Siguiente</button>
                    </div>
                </div>
 
                {{-- PASO 2: Datos técnicos e inventario --}}
                <div id="step-2" class="hidden">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
                        <div class="px-6 py-3 border-b border-gray-100">
                            <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wider">Datos Técnicos e Inventario</h3>
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
                                       value="{{ old('isbn') }}">
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
                                       value="{{ old('paginas') }}">
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
                                    <option value="espanol"  {{ old('idioma', 'espanol') == 'espanol'  ? 'selected' : '' }}>Español</option>
                                    <option value="ingles"   {{ old('idioma') == 'ingles'   ? 'selected' : '' }}>Inglés</option>
                                    <option value="frances"  {{ old('idioma') == 'frances'  ? 'selected' : '' }}>Francés</option>
                                    <option value="aleman"   {{ old('idioma') == 'aleman'   ? 'selected' : '' }}>Alemán</option>
                                    <option value="portugues"{{ old('idioma') == 'portugues'? 'selected' : '' }}>Portugués</option>
                                    <option value="otro"     {{ old('idioma') == 'otro'     ? 'selected' : '' }}>Otro</option>
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
                                       value="{{ old('inventario', 0) }}" required>
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
                                           value="{{ old('precio') }}">
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
                                       value="{{ old('edicion') }}">
                                @error('edicion')
                                    <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>
 
                        </div>
                    </div>

                    {{-- Botones paso 2 --}}
                    <div class="mt-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <button type="button" onclick="goToStep1()" class="w-full sm:w-auto bg-white hover:bg-gray-50 border border-gray-300 text-gray-700 font-semibold py-2.5 px-4 rounded-lg transition">Atrás</button>
                        <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                            <a href="{{ route('libros.index') }}" class="w-full sm:w-auto bg-white hover:bg-gray-50 border border-gray-300 text-gray-700 font-semibold py-2.5 px-4 rounded-lg transition">Cancelar</a>
                            <button type="submit" class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white font-semibold py-2.5 px-4 rounded-lg shadow transition">Guardar</button>
                        </div>
                    </div>
                </div>
 
            </form>
        </div>
    </div>
 
    <script>
        function goToStep2() {
            const titulo = document.getElementById('titulo');
            const autor  = document.getElementById('autor');
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
 
        // Si hay errores de validación del servidor en paso 2, ir directo al paso 2
        @if ($errors->hasAny(['isbn', 'paginas', 'idioma', 'inventario', 'precio', 'edicion']))
            goToStep2();
        @endif
    </script>
</x-app-layout>