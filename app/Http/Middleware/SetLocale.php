<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        // Obtener el locale de la sesión o usar el predeterminado del sistema.
        $locale = Session::get('locale', config('app.locale'));

        // Si el usuario está autenticado, preferir su locale configurado.
        if (Auth::check()) {
            $user = Auth::user();
            $locale = $user->locale; // Usar el locale del usuario autenticado
            Log::info('Usando locale del usuario autenticado: ' . $locale);
        }

        // Establecer el locale de la aplicación.
        App::setLocale($locale);
        Log::info('Locale establecido a: ' . $locale);

        return $next($request);
    }
}
