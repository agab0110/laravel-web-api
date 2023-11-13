<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(LoginRequest $request) {
        $validated = $request->validated();     // validazione dei campi

        if (!Auth::attempt($validated)) {       // Auth è una funzione di laravel per l'autenticazione
            return response()->json([
                'message' => 'Invalid login information',   // se il tentativo non va a buon fine allora torniamo un 404, altrimenti
            ], 404);
        }

        $user = User::where('email', $validated['email'])->first();     // cerchiamo l'utente nel database

        return response()->json([
            'access_token' => $user->createToken('api_token')->plainTextToken,      // ritorniamo il token di accesso dell'utente come testo
            'token_type' => 'Bearer'    // Bearer è il tipo di token
        ]);
    }
}
