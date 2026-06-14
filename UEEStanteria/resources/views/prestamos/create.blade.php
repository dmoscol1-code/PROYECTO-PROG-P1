<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Nueva Persona') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('personas.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="nombre">
                                {{ __('Nombre') }}
                            </label>
                            <input type="text" name="nombre" id="nombre" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nombre') border-red-500 @enderror" 
                                value="{{ old('nombre') }}" required>
                            @error('nombre')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                                {{ __('Email') }}
                            </label>
                            <input type="email" name="email" id="email" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror" 
                                value="{{ old('email') }}" required>
                            @error('email')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-3">
                                {{ __('Intereses') }}
                            </label>
                            @if ($intereses->count())
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-3 mb-4">
                                    @foreach($intereses as $interes)
                                        <label class="inline-flex items-center p-2 border rounded hover:bg-gray-50">
                                            <input type="checkbox" name="intereses[]" value="{{ $interes->id }}" 
                                                class="w-4 h-4 text-blue-600" 
                                                {{ in_array($interes->id, old('intereses', [])) ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700 font-medium">{{ $interes->nombre }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-600 italic">{{ __('No hay intereses disponibles') }}</p>
                            @endif
                            @error('intereses')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex gap-4">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline">
                                {{ __('Guardar Persona') }}
                            </button>
                            <a href="{{ route('personas.index') }}" class="inline-block bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-6 rounded">
                                {{ __('Cancelar') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
