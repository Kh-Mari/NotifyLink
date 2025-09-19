<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\TranslationService;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $locale = TranslationService::getCurrentLocale();
        app()->setLocale($locale);
        
        return $next($request);
    }
}