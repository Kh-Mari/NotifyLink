@extends('layouts.app')

@section('title', t('login') . ' - NotifySmartLink')
@section('content')
<div style="max-width: 400px; margin: 2rem auto; background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
    <div style="text-align: center; margin-bottom: 2rem;">
        <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #3b82f6, #1d4ed8); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; color: white; font-size: 2rem;">
            <i class="fas fa-bell"></i>
        </div>
        <h1 style="font-size: 2rem; margin-bottom: 0.5rem;">{{ t('welcome_back') }}</h1>
        <p style="color: #64748b;">{{ t('sign_in_to_app') }}</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div style="margin-bottom: 1rem;">
            <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">{{ t('email_address') }}</label>
            <input type="email" name="email" style="width: 100%; padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 1rem;" placeholder="{{ t('enter_email') }}" required value="{{ old('email') }}">
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">{{ t('password') }}</label>
            <input type="password" name="password" style="width: 100%; padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 1rem;" placeholder="{{ t('enter_password') }}" required>
        </div>

        <button type="submit" style="width: 100%; padding: 1rem; background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: white; border: none; border-radius: 8px; font-size: 1rem; font-weight: 600; cursor: pointer;">
            <i class="fas fa-sign-in-alt"></i> {{ t('sign_in') }}
        </button>
    </form>
</div>
@endsection