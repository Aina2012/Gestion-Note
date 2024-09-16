<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EtudiantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
$numero = $request->input('numero');

// Vérifie si l'utilisateur est déjà connecté
if (Auth::check()) {
    return $next($request);
}

// Vérifie si le numéro existe dans la base de données
$etudiant = Etudiant::where('id_etudiant', $numero)->first();

// Si l'utilisateur existe, créez une session temporaire pour simuler une connexion
if ($etudiant) {
    Auth::shouldUse('etudiant');
    Auth::login($etudiant);
    Auth::setUserResolver(function () use ($etudiant) {
        return $etudiant;
    });
        }

        return $next($request);
    
    }
}