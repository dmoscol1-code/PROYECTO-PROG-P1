<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    public function index()
    {
        $q = request('q');
        $categoria = request('categoria');
        $disponible = request('disponible');

        $query = Libro::query();

        if ($q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('titulo', 'like', "%{$q}%")
                    ->orWhere('autor', 'like', "%{$q}%")
                    ->orWhere('isbn', 'like', "%{$q}%");
            });
        }

        if ($categoria) {
            $query->where('categoria', $categoria);
        }

        if ($disponible !== null && $disponible !== '') {
            if ($disponible == '1') {
                $query->where('inventario', '>', 0);
            } else {
                $query->where('inventario', '<=', 0);
            }
        }

        $libros = $query->orderBy('created_at', 'desc')->paginate(12)->withQueryString();

        return view('libros.index', compact('libros'));
    }

    public function create()
    {
        return view('libros.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'editorial' => 'nullable|string|max:255',
            'categoria' => 'nullable|string|max:100',
            'anio_publicacion' => 'nullable|integer|min:1000|max:' . date('Y'),
            'isbn' => 'nullable|string|max:50',
            'paginas' => 'nullable|integer|min:1',
            'idioma' => 'nullable|string|max:50',
            'inventario' => 'nullable|integer|min:0',
            'precio' => 'nullable|numeric|min:0',
            'edicion' => 'nullable|string|max:100',
        ]);

        Libro::create($data);

        return redirect()->route('libros.index')->with('success', 'Libro creado correctamente.');
    }

    public function edit(Libro $libro)
    {
        return view('libros.edit', compact('libro'));
    }

    public function update(Request $request, Libro $libro)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'editorial' => 'nullable|string|max:255',
            'categoria' => 'nullable|string|max:100',
            'anio_publicacion' => 'nullable|integer|min:1000|max:' . date('Y'),
            'isbn' => 'nullable|string|max:50',
            'paginas' => 'nullable|integer|min:1',
            'idioma' => 'nullable|string|max:50',
            'inventario' => 'nullable|integer|min:0',
            'precio' => 'nullable|numeric|min:0',
            'edicion' => 'nullable|string|max:100',
        ]);

        $libro->update($data);

        return redirect()->route('libros.index')->with('success', 'Libro actualizado correctamente.');
    }

    public function destroy(Libro $libro)
    {
        $libro->delete();

        return redirect()->route('libros.index')->with('success', 'Libro eliminado correctamente.');
    }
}
