<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Personas') }}
            </h2>
            <a href="{{ route('personas.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                {{ __('Nueva Persona') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($personas->count())
                        <table class="min-w-full bg-white border border-gray-300">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border border-gray-300 px-4 py-2 text-left">{{ __('Nombre') }}</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">{{ __('Email') }}</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">{{ __('Intereses') }}</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">{{ __('Acciones') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($personas as $persona)
                                    <tr class="hover:bg-gray-50">
                                        <td class="border border-gray-300 px-4 py-2">{{ $persona->nombre }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $persona->email }}</td>
                                        <td class="border border-gray-300 px-4 py-2">
                                            @forelse ($persona->intereses as $interes)
                                                <span class="inline-block bg-blue-200 text-blue-800 px-2 py-1 rounded text-sm mr-1">{{ $interes->nombre }}</span>
                                            @empty
                                                <span class="text-gray-500">{{ __('Sin intereses') }}</span>
                                            @endforelse
                                        </td>
                                        <td class="border border-gray-300 px-4 py-2">
                                            <a href="{{ route('personas.edit', $persona->id) }}" class="text-blue-500 hover:underline">{{ __('Editar') }}</a>
                                            <form action="{{ route('personas.destroy', $persona->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:underline">{{ __('Eliminar') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-gray-600">{{ __('No hay personas registradas.') }} <a href="{{ route('personas.create') }}" class="text-blue-500 hover:underline">{{ __('Crear una') }}</a></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
