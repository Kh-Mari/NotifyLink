<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Link;
use App\Models\Button;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function dashboard()
    {
        $users = User::with('link')->orderBy('created_at', 'desc')->get();
        $links = Link::with(['user', 'buttons'])->orderBy('created_at', 'desc')->get();
        
        $totalVisits = $links->sum('visit_count');
        $totalButtons = $links->sum(function ($link) {
            return $link->buttons->count();
        });
        
        return view('admin.dashboard', compact('users', 'links', 'totalVisits', 'totalButtons'));
    }

    public function showRegister()
    {
        return view('admin.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'email' => strtolower(trim($request->email)),
            'password' => Hash::make($request->password),
            'is_admin' => $request->has('is_admin'),
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', "User {$user->email} created successfully.");
    }

    public function editLink($linkId)
    {
        $link = Link::with('user')->findOrFail($linkId);
        return view('admin.edit-link', compact('link'));
    }

    public function updateLink(Request $request, $linkId)
    {
        $link = Link::findOrFail($linkId);
        
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
        
        try {
            // Handle logo upload
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $filename = $this->generateUniqueFilename($file);
                $file->storeAs('public/uploads', $filename);
                $link->logo_filename = $filename;
            }
            
            // Handle background upload
            if ($request->hasFile('background')) {
                $file = $request->file('background');
                $filename = $this->generateUniqueFilename($file);
                $file->storeAs('public/uploads', $filename);
                $link->background_filename = $filename;
            }
            
            // Update all settings with defaults
            $link->button_color = $request->get('button_color', '#3b82f6');
            $link->background_color = $request->get('background_color', '#ffffff');
            $link->text_color = $request->get('text_color', '#333333');
            $link->button_style = $request->get('button_style', 'rounded');
            $link->logo_shape = $request->get('logo_shape', 'circle');
            $link->logo_size = $request->get('logo_size', 'medium');
            $link->background_style = $request->get('background_style', 'cover');
            $link->use_background_image = $request->has('use_background_image');
            
            // Update container settings with defaults
            $link->container_background = $request->get('container_background', '#ffffff');
            $link->container_border_color = $request->get('container_border_color', '#e5e7eb');
            $link->container_border_width = (int) $request->get('container_border_width', 1);
            $link->container_border_radius = (int) $request->get('container_border_radius', 20);
            $link->container_shadow = $request->has('container_shadow');
            $link->container_blur = $request->has('container_blur');
            $link->container_opacity = (int) $request->get('container_opacity', 95);
            $link->use_container_styling = $request->has('use_container_styling');
            
            $link->save();
            
            return redirect()->route('admin.edit-link', $linkId)
                ->with('success', 'Link updated successfully.');
        } catch (Exception $e) {
            return redirect()->route('admin.edit-link', $linkId)
                ->with('danger', 'Error updating link. Please try again.');
        }
    }



    public function searchUsers(Request $request)
    {
        $query = trim($request->get('q', ''));
        
        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $users = User::where('email', 'like', "%{$query}%")
            ->whereDoesntHave('link')
            ->limit(10)
            ->get(['id', 'email']);

        return response()->json($users);
    }

    public function createLink(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'slug' => 'required|min:3|unique:links',
        ]);

        $userId = $request->user_id;
        $slug = strtolower(trim($request->slug));

        // Check if user already has a link
        if (User::find($userId)->link) {
            return redirect()->route('admin.dashboard')
                ->with('danger', 'User already has a link assigned.');
        }

        Link::create([
            'user_id' => $userId,
            'slug' => $slug,
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', "Link created: {$slug}");
    }

    public function deleteUser($userId)
    {
        $user = User::findOrFail($userId);
        
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.dashboard')
                ->with('danger', 'Cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('admin.dashboard')
            ->with('info', "User {$user->email} deleted.");
    }

    public function deleteLink($linkId)
    {
        $link = Link::findOrFail($linkId);
        $slug = $link->slug;
        $link->delete();

        return redirect()->route('admin.dashboard')
            ->with('info', "Link {$slug} deleted.");
    }

    private function generateUniqueFilename($file)
    {
        $extension = $file->getClientOriginalExtension();
        $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        return $name . '_' . substr(Str::uuid()->toString(), 0, 8) . '.' . $extension;
    }
}
