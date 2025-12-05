<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Categoria::query();

        if($request->filled('search')){
            $search = $request->search;
            $query->where(function($q) use ($search){
                $q->where('nombre', 'like', "%$search%")
                  ->orWhere('descripcion', 'like', "%$search%");
            });
        }

        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order','desc');
        $query->orderBy($sortBy,$sortOrder);

        $categorias = $query->withCount('proyectos')->paginate(10);
        
        return view('admin.categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre',
            'descripcion' => 'nullable|string|max:1000',
        ],[
            'nombre.required' => 'Es obligatorio el nombre de la categoria',
            'nombre.unique' => 'Ya existe una categoria con este nombre',
            'nombre.max' => 'El nombre no puede exceder los 255 caracteres',
            'descripcion.max' => 'La descripcion no puede exceder los 1000 caracteres',
        ]);

        try{
            Categoria::create($validated);
            return redirect()
                ->route('admin.categorias.index')
                ->with('success','Categoria creada exitosamente.');
        }catch(\Exception $e){
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => 'Error al crear la categoria: '.$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('admin.categorias.edit',compact('categoria'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $categoria = Categoria::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre,' . $id,
            'descripcion' => 'nullable|string|max:1000',
        ], [
            'nombre.required' => 'El nombre de la categoría es obligatorio.',
            'nombre.unique' => 'Ya existe una categoría con este nombre.',
            'nombre.max' => 'El nombre no puede exceder 255 caracteres.',
            'descripcion.max' => 'La descripción no puede exceder 1000 caracteres.',
        ]);

        try{
            $categoria->update($validated);

            return redirect()
                ->route('admin.categorias.index')
                ->with('success', 'Categoria actualizada exitosamente');
        }catch(\Exception $e){
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => 'Error al actualizar la categoria: '.$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $categoria = Categoria::findOrFail($id);

        // Verificar si tiene proyectos asociados
        if ($categoria->proyectos()->count() > 0) {
            return redirect()
                ->back()
                ->with('error', 'No se puede eliminar la categoría porque tiene proyectos asociados.');
        }

        try {
            $categoria->delete();

            return redirect()
                ->route('admin.categorias.index')
                ->with('success', 'Categoría eliminada exitosamente.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error al eliminar la categoría: ' . $e->getMessage());
        }
    }
}