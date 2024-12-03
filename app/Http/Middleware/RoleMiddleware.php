<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Vérifie si l'utilisateur est connecté
        if (!Auth::check()) {
            abort(403, 'Accès interdit : vous devez être connecté pour accéder à cette page.');
        }

        // Récupère le rôle de l'utilisateur
        $userRole = Auth::user()->role;

        // Vérifie si le rôle de l'utilisateur est dans la liste des rôles autorisés
        if (!in_array($userRole, $roles)) {
            $message = "Accès interdit : votre rôle est \"$userRole\", mais cette page est réservée aux rôles : " . implode(', ', $roles) . '.';
            abort(403, $message); // Renvoie une erreur 403 avec le message personnalisé
        }

        return $next($request);
    }
}
