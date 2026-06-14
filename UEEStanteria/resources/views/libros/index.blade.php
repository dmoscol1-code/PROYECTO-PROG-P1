<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Intereses') }}
            </h2>
            <a href="{{ route('intereses.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                {{ __('Nuevo Interés') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($intereses->count())
                        <table class="min-w-full bg-white border border-gray-300">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border border-gray-300 px-4 py-2 text-left">{{ __('Nombre') }}</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">{{ __('Descripción') }}</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">{{ __('Acciones') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($intereses as $interes)
                                    <tr class="hover:bg-gray-50">
                                        <td class="border border-gray-300 px-4 py-2">{{ $interes->nombre }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $interes->descripcion }}</td>
                                        <td class="border border-gray-300 px-4 py-2">
                                            <a href="{{ route('intereses.edit', $interes->id) }}" class="text-blue-500 hover:underline">{{ __('Editar') }}</a>
                                            <form action="{{ route('intereses.destroy', $interes->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro?')">
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
                        <p class="text-gray-600">{{ __('No hay intereses registrados.') }} <a href="{{ route('intereses.create') }}" class="text-blue-500 hover:underline">{{ __('Crear uno') }}</a></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
