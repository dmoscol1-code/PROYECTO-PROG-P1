<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Prestamo;
use Illuminate\Http\Request;

class PrestamoController extends Controller
{
    public function index()
    {
        $prestamos = Prestamo::with('libro')->orderBy('created_at', 'desc')->paginate(15);

        return view('prestamos.index', compact('prestamos'));
    }

    public function create(Request $request)
    {
        $libroId = $request->query('libro');
        $libros = Libro::orderBy('titulo')->get();
        $selectedLibro = $libroId ? Libro::find($libroId) : null;

        return view('prestamos.create', compact('libros', 'selectedLibro'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'libro_id' => 'required|exists:libros,id',
            'prestado_a' => 'required|string|max:255',
            'fecha_prestamo' => 'required|date',
            'fecha_devolucion' => 'nullable|date|after_or_equal:fecha_prestamo',
        ]);

        $libro = Libro::findOrFail($data['libro_id']);

        if ($libro->inventario <= 0) {
            return back()->withErrors(['libro_id' => 'No hay unidades disponibles para prestar este libro.'])->withInput();
        }

        Prestamo::create($data);
        $libro->decrement('inventario');

        return redirect()->route('prestamos.index')->with('success', 'Préstamo guardado correctamente.');
    }

    public function destroy(Prestamo $prestamo)
    {
        $libro = $prestamo->libro;

        if ($libro) {
            $libro->increment('inventario');
        }

        $prestamo->delete();

        return redirect()->route('prestamos.index')->with('success', 'Libro devuelto y préstamo eliminado correctamente.');
    }
}
