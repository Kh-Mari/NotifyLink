<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'NotifySmartLink')</title>
    <link rel="icon" type="image/x-icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🔗</text></svg>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; background: #f9fafb; color: #374151; margin: 0; }
        .container { max-width: 1200px; margin: 0 auto; padding: 2rem 1rem; }
        .alert { padding: 1rem; margin: 1rem 0; border-radius: 8px; }
        .alert-success { background: #d1fae5; color: #065f46; }
        .alert-danger { background: #fee2e2; color: #991b1b; }
        .alert-info { background: #dbeafe; color: #1e40af; }
    </style>
</head>
<body>
    <nav style="background: white; padding: 1rem; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <div style="max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center;">
            <a href="{{ route('home') }}" style="font-size: 1.5rem; font-weight: bold; color: #3b82f6; text-decoration: none;">
                <i class="fas fa-bell"></i> NotifySmartLink
            </a>
            <div>
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" style="margin-right: 1rem; color: #374151; text-decoration: none;">
                            <i class="fas fa-crown"></i> Admin Dashboard
                        </a>
                    @else
                        <a href="{{ route('user.dashboard') }}" style="margin-right: 1rem; color: #374151; text-decoration: none;">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" style="background: #ef4444; color: white; border: none; padding: 0.5rem 1rem; border-radius: 4px; cursor: pointer;">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" style="background: #3b82f6; color: white; padding: 0.5rem 1rem; border-radius: 4px; text-decoration: none;">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('danger'))
        <div class="alert alert-danger">{{ session('danger') }}</div>
    @endif
    @if(session('info'))
        <div class="alert alert-info">{{ session('info') }}</div>
    @endif
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif

    <div class="container">
        @yield('content')
    </div>
</body>
</html>