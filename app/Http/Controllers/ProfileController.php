<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),  
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validatedData = $request->validated();
        
        // Vérifier si des modifications ont été apportées
        $hasChanges = false;
        
        // Vérifier les changements d'email
        if (isset($validatedData['email']) && $validatedData['email'] !== $user->email) {
            $hasChanges = true;
        }
        
        // Vérifier si un nouveau mot de passe a été fourni
        if (isset($validatedData['password']) && !empty($validatedData['password'])) {
            $hasChanges = true;
        }
        
        // Si aucune modification n'a été effectuée, rediriger vers la page d'accueil
        if (!$hasChanges) {
            return Redirect::route('home')->with('info', 'Aucune modification n\'a été effectuée');
        }
        
        // Procéder à la mise à jour si des modifications existent
        $user->fill($validatedData);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}