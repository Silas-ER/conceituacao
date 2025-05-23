<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Exibe a lista de todos os perfis.
     */
    public function index(): View
    {
        $profiles = Profile::all();
        return view('profiles.index', compact('profiles'));
    }

    /**
     * Exibe o formulário para criar um novo perfil.
     */
    public function create(): View
    {
        return view('profiles.create');
    }

    /**
     * Armazena um novo perfil no banco de dados.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Profile::create($validatedData);

        return redirect()->route('profiles.index')->with('success', 'Perfil criado com sucesso!');
    }

    /**
     * Exibe o formulário para editar um perfil.
     */
    public function edit(Profile $profile): View
    {
        return view('profiles.edit', compact('profile'));
    }

    /**
     * Atualiza um perfil no banco de dados.
     */
    public function update(Request $request, Profile $profile): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $profile->update($validatedData);

        return redirect()->route('profiles.index')->with('success', 'Perfil editado com sucesso!');
    }

    /**
     * Remove um perfil do banco de dados.
     */
    public function destroy(Profile $profile): RedirectResponse
    {
        $profile->delete();

        return redirect()->route('profiles.index')->with('success', 'Perfil deletado com sucesso!');
    }
}