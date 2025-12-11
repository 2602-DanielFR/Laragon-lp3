<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PerfilController extends Controller
{
    /**
     * Display the specified resource.
     * Si no se pasa ID, muestra el perfil del usuario autenticado.
     */
    public function show($id = null)
    {
        if ($id) {
            $user = User::with(['donante', 'emprendedor', 'socialLinks'])->findOrFail($id);
        } else {
            $user = Auth::user()->load(['donante', 'emprendedor', 'socialLinks']);
        }

        $profile = null;
        if ($user->isDonante()) {
            $profile = $user->donante;
        } elseif ($user->isEmprendedor()) {
            $profile = $user->emprendedor;
        }

        return view('perfil.show', compact('user', 'profile'));
    }

    /**
     * Show the form for editing the authenticated user's profile.
     */
    public function edit()
    {
        $user = Auth::user()->load(['donante', 'emprendedor', 'socialLinks']);

        $profile = null;
        if ($user->isDonante()) {
            $profile = $user->donante;
        } elseif ($user->isEmprendedor()) {
            $profile = $user->emprendedor;
        }

        return view('perfil.edit', compact('user', 'profile'));
    }

    /**
     * Update the authenticated user's profile.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validación base para todos los usuarios
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'foto_perfil' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'biografia_breve' => ['nullable', 'string', 'max:2000'],
            'social_links' => ['nullable', 'array', 'max:5'],
            'social_links.*.platform' => ['required_with:social_links', 'string', 'max:50'],
            'social_links.*.url' => ['required_with:social_links', 'url', 'max:255'],
        ];

        // Validaciones específicas por rol
        if ($user->isDonante()) {
            $rules = array_merge($rules, [
                'organizacion' => ['nullable', 'string', 'max:255'],
                'direccion' => ['nullable', 'string', 'max:255'],
                'telefono' => ['nullable', 'string', 'max:20'],
            ]);
        } elseif ($user->isEmprendedor()) {
            $rules = array_merge($rules, [
                'organizacion' => ['nullable', 'string', 'max:255'],
                'descripcion_personal' => ['nullable', 'string', 'max:2000'],
            ]);
        }

        $data = $request->validate($rules);

        // ===== ACTUALIZAR USUARIO =====
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->save();

        // ===== ACTUALIZAR ENLACES SOCIALES =====
        $user->socialLinks()->delete();
        if (!empty($data['social_links'])) {
            foreach ($data['social_links'] as $link) {
                if (!empty($link['platform']) && !empty($link['url'])) {
                    $user->socialLinks()->create([
                        'platform' => $link['platform'],
                        'url' => $link['url']
                    ]);
                }
            }
        }

        // ===== ACTUALIZAR PERFIL RELACIONADO =====
        $relatedData = [
            'biografia_breve' => $data['biografia_breve'] ?? null,
        ];

        // Handle Profile Picture Upload
        if ($request->hasFile('foto_perfil')) {
            $path = $request->file('foto_perfil')->store('perfiles', 'public');
            $relatedData['foto_perfil'] = $path;
        }

        if ($user->isDonante()) {
            $relatedData['organizacion'] = $data['organizacion'] ?? null;
            $relatedData['direccion'] = $data['direccion'] ?? null;
            $relatedData['telefono'] = $data['telefono'] ?? null;

            $user->donante()->updateOrCreate(
                ['user_id' => $user->id],
                $relatedData
            );
        } elseif ($user->isEmprendedor()) {
            $relatedData['organizacion'] = $data['organizacion'] ?? null;
            $relatedData['descripcion_personal'] = $data['descripcion_personal'] ?? null;

            $user->emprendedor()->updateOrCreate(
                ['user_id' => $user->id],
                $relatedData
            );
        }

        return redirect()->route('perfil.edit')->with('success', 'Perfil actualizado correctamente.');
    }
}
