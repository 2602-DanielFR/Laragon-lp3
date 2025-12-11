<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Donante; // Added this line
use App\Models\Emprendedor; // Added this line
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Constructor - Middleware de autenticación y rol
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin'); // Asumiendo que existe un middleware admin
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $users = $query->paginate(10);

        $roles = ['Admin', 'Donante', 'Emprendedor']; // For filter dropdown

        return view('admin.users.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Not used, users register through public form
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Not used, users register through public form
        abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Show is handled by PerfilController for public view
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::with(['donante', 'emprendedor'])->findOrFail($id);
        $roles = ['Admin', 'Donante', 'Emprendedor'];

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => ['required', 'string', 'in:Admin,Donante,Emprendedor'],
        ];

        $validated = $request->validate($rules);

        try {
            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'role' => $validated['role'],
            ]);

            // If user's role changes, manage associated profiles
            if ($user->wasChanged('role')) {
                // Delete old profile if it exists
                if ($user->getOriginal('role') === 'Donante') {
                    $user->donante()->delete();
                } elseif ($user->getOriginal('role') === 'Emprendedor') {
                    $user->emprendedor()->delete();
                }

                // Create new profile if it's not Admin
                if ($user->role === 'Donante') {
                    Donante::firstOrCreate(['user_id' => $user->id]);
                } elseif ($user->role === 'Emprendedor') {
                    Emprendedor::firstOrCreate(['user_id' => $user->id]);
                }
            }

            return redirect()
                ->route('admin.users.index')
                ->with('success', 'Usuario actualizado exitosamente.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error al actualizar el usuario: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Prevent self-deletion if logged in as the user being deleted
        if (auth()->id() == $user->id) {
            return redirect()->back()->with('error', 'No puedes eliminar tu propia cuenta de administrador.');
        }

        try {
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar el usuario: ' . $e->getMessage());
        }
    }
}