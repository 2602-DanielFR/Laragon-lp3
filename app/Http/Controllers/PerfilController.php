<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with(['donante', 'emprendedor', 'socialLinks'])->findOrFail($id);

        $profile = null;
        if ($user->role === 'Donante') {
            $profile = $user->donante;
        } elseif ($user->role === 'Emprendedor') {
            $profile = $user->emprendedor;
        }

        return view('perfil.show', compact('user', 'profile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $auth = Auth::user();
        $user = User::with(['donante', 'emprendedor', 'socialLinks'])->findOrFail($auth->id);

        $profile = null;
        if ($user->role === 'Donante') {
            $profile = $user->donante;
        } elseif ($user->role === 'Emprendedor') {
            $profile = $user->emprendedor;
        }

        return view('perfil.edit', compact('user', 'profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'foto_perfil' => ['nullable', 'string', 'max:2048'],
            'biografia_breve' => ['nullable', 'string', 'max:2000'],
            'social_links' => ['nullable', 'array'],
            'social_links.*.platform' => ['required', 'string', 'max:50'],
            'social_links.*.url' => ['required', 'url', 'max:255'],
        ];

        if ($user->role === 'Donante') {
            $rules = array_merge($rules, [
                'direccion' => ['nullable', 'string', 'max:255'],
                'telefono' => ['nullable', 'string', 'max:50'],
            ]);
        } elseif ($user->role === 'Emprendedor') {
            $rules = array_merge($rules, [
                'organizacion' => ['nullable', 'string', 'max:255'],
                'descripcion_personal' => ['nullable', 'string', 'max:2000'],
            ]);
        }

        $data = $request->validate($rules);

        // Update User
        $user->name = $data['name'];
        $user->save();

        // Handle Social Links
        // Sync strategy: delete all and recreate (simple and effective for this scale)
        $user->socialLinks()->delete();
        if (isset($data['social_links'])) {
            foreach ($data['social_links'] as $link) {
                if (!empty($link['url'])) {
                    $user->socialLinks()->create([
                        'platform' => $link['platform'],
                        'url' => $link['url']
                    ]);
                }
            }
        }

        // Prepare related data
        $relatedData = [
            'foto_perfil' => $data['foto_perfil'] ?? null,
            'biografia_breve' => $data['biografia_breve'] ?? null,
        ];

        if ($user->role === 'Donante') {
            $relatedData['direccion'] = $data['direccion'] ?? null;
            $relatedData['telefono'] = $data['telefono'] ?? null;

            $user->donante()->updateOrCreate(
                ['user_id' => $user->id],
                $relatedData
            );
        } elseif ($user->role === 'Emprendedor') {
            $relatedData['organizacion'] = $data['organizacion'] ?? null;
            $relatedData['descripcion_personal'] = $data['descripcion_personal'] ?? null;

            $user->emprendedor()->updateOrCreate(
                ['user_id' => $user->id],
                $relatedData
            );
        }

        return redirect()->route('perfil.edit')->with('status', 'Perfil actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
