<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {

        /*
        |--------------------------------------------------------------------------
        | UTILISATEUR NON CONNECTÉ
        |--------------------------------------------------------------------------
        */

        if (! $request->user()) {

            return redirect()
                ->route('login');
        }

        /*
        |--------------------------------------------------------------------------
        | UTILISATEUR NON ADMIN
        |--------------------------------------------------------------------------
        */

        if (! $request->user()->is_admin) {

            abort(
                403,
                'Accès réservé aux administrateurs.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | ADMIN AUTORISÉ
        |--------------------------------------------------------------------------
        */

        return $next($request);
    }
}
