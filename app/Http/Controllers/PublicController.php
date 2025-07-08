<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Button;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function showPublicPage($slug)
    {
        $link = Link::with(['activeButtons' => function ($query) {
            $query->orderBy('order');
        }])->where('slug', $slug)->firstOrFail();

        // Increment visit count
        $link->incrementVisitCount();

        return view('public.page', [
            'link' => $link,
            'buttons' => $link->activeButtons,
        ]);
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
