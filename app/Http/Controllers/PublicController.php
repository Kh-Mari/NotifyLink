<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Button;
use Illuminate\Http\Request;
use App\Services\TranslationService; 
class PublicController extends Controller
{
     public function showPublicPage($slug, Request $request)
    {
        // Get locale from URL parameter first, then cookie, then default
        $locale = $request->get('lang', $request->cookie('locale', 'en'));
        
        // Validate and set locale
        if (in_array($locale, ['en', 'ar'])) {
            TranslationService::SetLocale($locale);
            app()->setLocale($locale);
        }
        
        $link = Link::where('slug', $slug)
            ->with(['buttons' => function($query) {
                $query->where('is_active', true)->orderBy('order');
            }])
            ->firstOrFail();
        
        // Increment visit count
        $link->increment('visit_count');
        
        $buttons = $link->buttons;
        
        return view('public.page', compact('link', 'buttons'))
            ->withCookie(cookie('locale', $locale, 60 * 24 * 365));
    }

    public function trackClick($buttonId)
    {
        $button = Button::findOrFail($buttonId);
        
        // Increment click count
        $button->incrementClickCount();

        $redirectUrl = $button->redirect_url;
        
        if (!$redirectUrl) {
            abort(404);
        }

        return redirect($redirectUrl);
    }

    public function serveUpload($filename)
    {
        $path = storage_path('app/public/uploads/' . $filename);
        
        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }
}
