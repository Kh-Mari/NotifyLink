<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TranslationService;

class LanguageController extends Controller
{
    public function switchLanguage($locale, Request $request)
    {
        // Validate locale
        if (!in_array($locale, ['en', 'ar'])) {
            abort(404);
        }

        // Set the locale (this will set both session and cookie)
        TranslationService::setLocale($locale);

        // Get redirect URL from query parameter or use previous URL
        $redirectUrl = $request->get('redirect', url()->previous());
        
        // Validate redirect URL to prevent open redirects
        if (!$redirectUrl || !filter_var($redirectUrl, FILTER_VALIDATE_URL)) {
            $redirectUrl = route('home');
        }

        return redirect($redirectUrl)->withCookies([
            cookie('locale', $locale, 60 * 24 * 365) // Set cookie for 1 year
        ]);
    }
}