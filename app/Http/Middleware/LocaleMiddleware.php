<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;


class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->segment(1); // First segment of the URL
        $supportedLocales = ['en', 'gr', 'it', 'ch', 'ae', 'fr', 'ru', 'sp'];

        if (!in_array($locale, $supportedLocales)) {
            // Redirect to default locale
            return redirect('/en' . $request->getPathInfo());
        }

        App::setLocale($locale);

        return $next($request);

    }
}
