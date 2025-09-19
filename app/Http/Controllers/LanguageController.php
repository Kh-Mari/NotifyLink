<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TranslationService;

class LanguageController extends Controller
{
    public function switchLanguage(Request $request, $locale)
    {
        // Validate locale
        if (!in_array($locale, ['en', 'ar'])) {
            abort(404);
        }
        
        // Set the locale in session
        TranslationService::setLocale($locale);
        
        // Check if there's a redirect parameter
        $redirectUrl = $request->query('redirect');
        if ($redirectUrl) {
            return redirect($redirectUrl);
        }
        
        // Redirect back to the previous page
        return redirect()->back()->with('success', TranslationService::get('settings_updated', $locale));
    }
}