<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateClient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         // Vérifier si l'utilisateur est authentifié en tant que client
        if (Auth::guard('client')->check()) {
            return $next($request); // Continuer la requête
        }

        // Redirection ou gestion de l'absence d'authentification
        return redirect()->route('/'); // Rediriger vers la page de connexion par exemple
    
    }
}