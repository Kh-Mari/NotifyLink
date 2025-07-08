<?php

namespace App\Http\Controllers;

use App\Models\License;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LicenseAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $licenses = License::orderBy('created_at', 'desc')->get();
        return view('license.dashboard', compact('licenses'));
    }

    public function create()
    {
        return view('license.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user' => 'required|string|max:255',
            'expires' => 'required|date|after:today'
        ]);

        License::create([
            'license_key' => License::generateLicenseKey(),
            'user' => $request->user,
            'expires' => $request->expires
        ]);

        return redirect()->route('admin.license.index')
            ->with('success', 'License generated successfully!');
    }

    public function edit(License $license)
    {
        return view('license.edit', compact('license'));
    }

    public function update(Request $request, License $license)
    {
        $request->validate([
            'user' => 'required|string|max:255',
            'expires' => 'required|date'
        ]);

        $license->update([
            'user' => $request->user,
            'expires' => $request->expires
        ]);

        return redirect()->route('admin.license.index')
            ->with('success', 'License updated successfully!');
    }

    public function destroy(License $license)
    {
        $license->delete();
        
        return redirect()->route('admin.license.index')
            ->with('success', 'License deleted successfully!');
    }
}