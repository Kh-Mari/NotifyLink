<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\TranslationService;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        // Get locale from various sources
        $locale = $request->get('lang') ?? 
                  session('locale') ?? 
                  $request->cookie('locale') ?? 
                  config('app.locale', 'en');
        
        if (in_array($locale, ['en', 'ar'])) {
            app()->setLocale($locale);
            TranslationService::setLocale($locale);
        }
        
        return $next($request);
    }
}