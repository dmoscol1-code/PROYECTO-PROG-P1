<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 leading-tight">{{ __('Gestión de Usuarios') }}</h2>
                <p class="text-sm text-gray-500 mt-1">{{ __('Usuarios registrados en el sistema') }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">{{ __('Usuarios Registrados') }}</h3>
                        <p class="text-sm text-gray-500">{{ __('Lista de cuentas activas') }}</p>
                    </div>
                    <span class="text-sm text-gray-500">{{ $usuarios->count() }} {{ __('usuarios') }}</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-red-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-red-700">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-red-700">Nombre</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-red-700">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-red-700">Registrado el</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100 text-sm text-gray-700">
                            @forelse($usuarios as $usuario)
                                <tr class="hover:bg-red-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $usuario->id }}</td>
                                    <td class="px-6 py-4">{{ $usuario->name }}</td>
                                    <td class="px-6 py-4">{{ $usuario->email }}</td>
                                    <td class="px-6 py-4">{{ $usuario->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-10 text-center text-sm text-gray-500">
                                        {{ __('No hay usuarios registrados aún.') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if(method_exists($usuarios, 'hasPages') && $usuarios->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                        {{ $usuarios->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
