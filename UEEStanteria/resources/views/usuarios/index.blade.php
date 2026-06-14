<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>EjemploSeg@yield('title', 'Dashboard')</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-100 font-sans antialiased">
        @extends('layouts.plantilla')
@section('title', 'Gestión de Usuarios')
@section('content')
<divclass="bg-whitep-6 rounded-lgshadow-md">
<h2 class="text-2xl font-boldmb-4 text-gray-800">Usuarios Registrados</h2>
<divclass="overflow-x-auto">
<table class="min-w-full bg-whiteborderborder-gray-200">
<thead>
<trclass="bg-gray-100 text-gray-600 uppercasetext-smleading-normal">
<thclass="py-3 px-6 text-left">ID</th>
<thclass="py-3 px-6 text-left">Nombre</th>
<thclass="py-3 px-6 text-left">Email</th>
<thclass="py-3 px-6 text-left">Fecha de Registro</th>
</tr>
</thead>
<tbodyclass="text-gray-600 text-smfont-light">
@foreach($usuarios as $usuario)
<trclass="border-b border-gray-200 hover:bg-gray-50">
<tdclass="py-3 px-6 text-leftwhitespace-nowrap">{{ $usuario->id }}</td>
<tdclass="py-3 px-6 text-left">{{ $usuario->name}}</td>
<tdclass="py-3 px-6 text-left">{{ $usuario->email }}</td>
<tdclass="py-3 px-6 text-left">{{ $usuario->created_at->format('d/m/Y H:i') }}</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
@endsection
    </body>
</html>
