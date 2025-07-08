<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Button;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $link = auth()->user()->link()->with(['buttons' => function($query) {
            $query->orderBy('order');
        }])->first();
        return view('user.dashboard', compact('link'));
    }

    public function updateSettings(Request $request)
    {
        $link = auth()->user()->link;
        
        if (!$link) {
            abort(404, 'No link assigned to your account.');
        }

        // Validate all inputs including container settings
        $request->validate([
            'button_color' => 'nullable|regex:/^#[0-9A-Fa-f]{6}$/',
            'background_color' => 'nullable|regex:/^#[0-9A-Fa-f]{6}$/',
            'text_color' => 'nullable|regex:/^#[0-9A-Fa-f]{6}$/',
            'button_style' => 'nullable|in:rounded,pill,square',
            'logo_shape' => 'nullable|in:circle,rounded,square',
            'logo_size' => 'nullable|in:small,medium,large',
            'background_style' => 'nullable|in:cover,contain,repeat,center',
            'container_background' => 'nullable|regex:/^#[0-9A-Fa-f]{6}$/',
            'container_border_color' => 'nullable|regex:/^#[0-9A-Fa-f]{6}$/',
            'container_border_width' => 'nullable|integer|min:0|max:10',
            'container_border_radius' => 'nullable|integer|min:0|max:50',
            'container_opacity' => 'nullable|integer|min:0|max:100',
            'logo' => 'nullable|image|max:5120', // 5MB
            'background' => 'nullable|image|max:10240', // 10MB
        ]);

        $data = $request->only([
            'button_color', 'background_color', 'text_color', 'button_style',
            'logo_shape', 'logo_size', 'background_style', 'container_background',
            'container_border_color', 'container_border_width', 'container_border_radius',
            'container_opacity'
        ]);
        
        // Handle boolean fields
        $data['use_background_image'] = $request->has('use_background_image');
        $data['container_shadow'] = $request->has('container_shadow');
        $data['container_blur'] = $request->has('container_blur');
        $data['use_container_styling'] = $request->has('use_container_styling');

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = $this->generateUniqueFilename($file);
            $file->storeAs('public/uploads', $filename);
            $data['logo_filename'] = $filename;
        }

        // Handle background upload
        if ($request->hasFile('background')) {
            $file = $request->file('background');
            $filename = $this->generateUniqueFilename($file);
            $file->storeAs('public/uploads', $filename);
            $data['background_filename'] = $filename;
        }

        // Set defaults for missing values
        $data['button_color'] = $data['button_color'] ?? '#3b82f6';
        $data['background_color'] = $data['background_color'] ?? '#ffffff';
        $data['text_color'] = $data['text_color'] ?? '#333333';
        $data['button_style'] = $data['button_style'] ?? 'rounded';
        $data['logo_shape'] = $data['logo_shape'] ?? 'circle';
        $data['logo_size'] = $data['logo_size'] ?? 'medium';
        $data['background_style'] = $data['background_style'] ?? 'cover';
        $data['container_background'] = $data['container_background'] ?? '#ffffff';
        $data['container_border_color'] = $data['container_border_color'] ?? '#e5e7eb';
        $data['container_border_width'] = $data['container_border_width'] ?? 1;
        $data['container_border_radius'] = $data['container_border_radius'] ?? 20;
        $data['container_opacity'] = $data['container_opacity'] ?? 95;

        $link->update($data);

        return redirect()->route('user.dashboard')
            ->with('success', 'Settings updated successfully.');
    }

    public function addButton(Request $request)
    {
        $link = auth()->user()->link;
        
        if (!$link) {
            abort(404, 'No link assigned to your account.');
        }

        $request->validate([
            'label' => 'required|max:64',
            'url' => 'nullable|url|max:512',
            'file' => 'nullable|file|max:16384', // 16MB
            'icon_class' => 'nullable|max:64',
            'order' => 'integer|min:0',
            'promotion_color' => 'nullable|regex:/^#[0-9A-Fa-f]{6}$/',
            'discount_label' => 'nullable|max:32',
        ]);

        $data = $request->only([
            'label', 'url', 'icon_class', 'order', 'promotion_color', 'discount_label'
        ]);
        
        $data['link_id'] = $link->id;
        $data['is_promotion'] = $request->has('is_promotion');

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $this->generateUniqueFilename($file);
            $file->storeAs('public/uploads', $filename);
            $data['file_filename'] = $filename;
        }

        // Validate that either URL or file is provided
        if (empty($data['url']) && empty($data['file_filename'])) {
            return redirect()->route('user.dashboard')
                ->with('danger', 'Either URL or file must be provided.');
        }

        Button::create($data);

        return redirect()->route('user.dashboard')
            ->with('success', 'Button added successfully.');
    }

    public function editButton($buttonId)
    {
        $button = Button::whereHas('link', function ($query) {
            $query->where('user_id', auth()->id());
        })->findOrFail($buttonId);

        return response()->json([
            'id' => $button->id,
            'label' => $button->label,
            'url' => $button->url,
            'icon_class' => $button->icon_class,
            'order' => $button->order,
            'is_promotion' => $button->is_promotion,
            'promotion_color' => $button->promotion_color,
            'discount_label' => $button->discount_label,
            'file_filename' => $button->file_filename
        ]);
    }

    public function updateButton(Request $request, $buttonId)
    {
        $button = Button::whereHas('link', function ($query) {
            $query->where('user_id', auth()->id());
        })->findOrFail($buttonId);

        $request->validate([
            'label' => 'required|max:64',
            'url' => 'nullable|url|max:512',
            'file' => 'nullable|file|max:16384',
            'icon_class' => 'nullable|max:64',
            'order' => 'integer|min:0',
            'promotion_color' => 'nullable|regex:/^#[0-9A-Fa-f]{6}$/',
            'discount_label' => 'nullable|max:32',
        ]);

        $data = $request->only([
            'label', 'url', 'icon_class', 'order', 'promotion_color', 'discount_label'
        ]);
        
        $data['is_promotion'] = $request->has('is_promotion');

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $this->generateUniqueFilename($file);
            $file->storeAs('public/uploads', $filename);
            $data['file_filename'] = $filename;
        }

        // Validate that either URL or file is provided
        if (empty($data['url']) && empty($data['file_filename']) && empty($button->file_filename)) {
            return redirect()->route('user.dashboard')
                ->with('danger', 'Either URL or file must be provided.');
        }

        $button->update($data);

        return redirect()->route('user.dashboard')
            ->with('success', 'Button updated successfully.');
    }

    public function deleteButton($buttonId)
    {
        $button = Button::whereHas('link', function ($query) {
            $query->where('user_id', auth()->id());
        })->findOrFail($buttonId);

        $button->delete();

        return redirect()->route('user.dashboard')
            ->with('info', 'Button deleted successfully.');
    }

    public function toggleButton($buttonId)
    {
        $button = Button::whereHas('link', function ($query) {
            $query->where('user_id', auth()->id());
        })->findOrFail($buttonId);

        $button->update(['is_active' => !$button->is_active]);

        $status = $button->is_active ? 'activated' : 'deactivated';
        
        return redirect()->route('user.dashboard')
            ->with('info', "Button {$status} successfully.");
    }

    public function reorderButtons(Request $request)
    {
        $link = auth()->user()->link;
        
        if (!$link) {
            return response()->json(['success' => false, 'message' => 'No link found']);
        }

        $buttonIds = $request->input('button_ids', []);
        
        foreach ($buttonIds as $index => $buttonId) {
            Button::where('id', $buttonId)
                ->where('link_id', $link->id)
                ->update(['order' => $index]);
        }

        return response()->json(['success' => true]);
    }

    private function generateUniqueFilename($file)
    {
        $extension = $file->getClientOriginalExtension();
        $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        return $name . '_' . substr(Str::uuid()->toString(), 0, 8) . '.' . $extension;
    }
}