<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class AdminProfileController extends Controller
{
    /**
     * Afficher le formulaire d'édition du profil de l'admin.
     */
    public function edit()
    {
        $admin = auth('admin')->user(); // Récupérer l'admin connecté
        return view('livewire.admin.profile.profile', compact('admin'));
    }

    /**
     * Mettre à jour le profil de l'admin.
     */
    public function update(Request $request)
    {
        $admin = auth('admin')->user();

        // Validation des données
        $validatedData = $request->validate([
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        // Mise à jour de l'email
        $admin->email = $validatedData['email'];

        // Mise à jour du mot de passe si un nouveau mot de passe est fourni
        if (!empty($validatedData['password'])) {
            $admin->password = Hash::make($validatedData['password']);
        }

        $admin->save();

        return redirect()->route('admin.dashboard')->with('success', 'Votre profil a été mis à jour avec succès.');
    }
}
