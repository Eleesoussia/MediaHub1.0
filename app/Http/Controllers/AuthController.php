<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // === INSCRIPTION ===
    public function createInscription()
    {
        return view('auth.inscription');
    }

    public function storeInscription(StoreUserRequest $request)
    {
        $utilisateur = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password,
            'role'     => 'auteur',
        ]);

        Auth::login($utilisateur);

        return redirect()
            ->route('accueil')
            ->with('succes', 'Bienvenue sur MediaHub, ' . $utilisateur->name . ' !');
    }

    // === CONNEXION ===
    public function createConnexion()
    {
        return view('auth.connexion');
    }

    public function connecter(Request $request)
    {
        $identifiants = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (! Auth::attempt($identifiants)) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Identifiants incorrects.']);
        }

        $request->session()->regenerate();

        return redirect()
            ->intended(route('accueil'))
            ->with('succes', 'Connexion réussie.');
    }

    // === DÉCONNEXION ===
    public function deconnecter(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('accueil')
            ->with('succes', 'Vous êtes déconnecté.');
    }
}