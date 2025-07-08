@extends('layouts.app')

@section('title', 'Register User')

@section('content')
<div style="max-width: 500px; margin: 2rem auto;">
    <div style="background: white; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); padding: 2rem;">
        <div style="text-align: center; margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 2px solid #f8fafc;">
            <h2 style="color: #1e293b; font-weight: 700; margin-bottom: 0.5rem;">Register New User</h2>
            <p style="color: #64748b; margin: 0;">Create a new user account</p>
        </div>

        <form method="POST" action="{{ route('admin.register') }}">
            @csrf
            <div style="margin-bottom: 1.5rem;">
                <label for="email" style="display: block; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Email Address</label>
                <input type="email" name="email" id="email" style="width: 100%; padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 1rem;" value="{{ old('email') }}" required>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label for="password" style="display: block; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Password</label>
                <input type="password" name="password" id="password" style="width: 100%; padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 1rem;" required>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: flex; align-items: center; gap: 0.5rem;">
                    <input type="checkbox" name="is_admin" id="is_admin" value="1" style="transform: scale(1.2);">
                    <span style="font-weight: 600; color: #374151;">Administrator privileges</span>
                </label>
            </div>

            <div style="display: flex; gap: 1rem; justify-content: center; margin-top: 2rem;">
                <a href="{{ route('admin.dashboard') }}" style="padding: 0.75rem 1.5rem; background: #6b7280; color: white; border-radius: 8px; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;">
                    <i class="fas fa-arrow-left"></i>Back to Dashboard
                </a>
                <button type="submit" style="padding: 0.75rem 1.5rem; background: linear-gradient(135deg, #10b981, #059669); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 0.5rem;">
                    <i class="fas fa-user-plus"></i>Create User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
