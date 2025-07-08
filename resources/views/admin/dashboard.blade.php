@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<style>
    .card { background: white; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); padding: 2rem; margin-bottom: 2rem; }
    .form-control { padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 1rem; }
    .btn { padding: 0.75rem 1.5rem; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; }
    .btn-primary { background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: white; }
    .btn-success { background: linear-gradient(135deg, #10b981, #059669); color: white; }
    .btn-danger { background: linear-gradient(135deg, #ef4444, #dc2626); color: white; }
    .table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
    .table th, .table td { padding: 1rem; text-align: left; border-bottom: 1px solid #e5e7eb; }
    .table th { background: #f8fafc; font-weight: 600; color: #374151; }
</style>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 2rem; border-radius: 16px; text-align: center;">
        <div style="font-size: 2.5rem; font-weight: 800; margin-bottom: 0.5rem;">{{ $users->count() }}</div>
        <div style="font-size: 0.9rem; opacity: 0.9;">Total Users</div>
    </div>
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 2rem; border-radius: 16px; text-align: center;">
        <div style="font-size: 2.5rem; font-weight: 800; margin-bottom: 0.5rem;">{{ $links->count() }}</div>
        <div style="font-size: 0.9rem; opacity: 0.9;">Active Links</div>
    </div>
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 2rem; border-radius: 16px; text-align: center;">
        <div style="font-size: 2.5rem; font-weight: 800; margin-bottom: 0.5rem;">{{ $totalVisits }}</div>
        <div style="font-size: 0.9rem; opacity: 0.9;">Total Visits</div>
    </div>
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 2rem; border-radius: 16px; text-align: center;">
        <div style="font-size: 2.5rem; font-weight: 800; margin-bottom: 0.5rem;">{{ $totalButtons }}</div>
        <div style="font-size: 0.9rem; opacity: 0.9;">Total Buttons</div>
    </div>
</div>

<div class="card">
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 2px solid #f8fafc;">
        <h4 style="margin: 0; color: #1e293b; font-weight: 700; font-size: 1.5rem; display: flex; align-items: center;">
            <i class="fas fa-plus-circle" style="margin-right: 0.75rem; color: #3b82f6; font-size: 1.25rem;"></i>Create New Link
        </h4>
    </div>
    
    <form method="POST" action="{{ route('admin.create-link') }}">
        @csrf
        <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 1rem; align-items: end;">
            <div>
                <label for="userSearch">Select User</label>
                <input type="text" id="userSearch" class="form-control" placeholder="Search for user..." autocomplete="off">
                <input type="hidden" name="user_id" id="selectedUserId">
            </div>
            <div>
                <label for="slug">Page Slug</label>
                <input type="text" name="slug" id="slug" class="form-control" placeholder="username" required>
            </div>
            <div>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-plus"></i>Create Link
                </button>
            </div>
        </div>
    </form>
</div>

<div class="card">
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 2px solid #f8fafc;">
        <h4 style="margin: 0; color: #1e293b; font-weight: 700; font-size: 1.5rem; display: flex; align-items: center;">
            <i class="fas fa-users" style="margin-right: 0.75rem; color: #3b82f6; font-size: 1.25rem;"></i>Users Management
        </h4>
        <a href="{{ route('admin.register') }}" class="btn btn-primary">
            <i class="fas fa-user-plus"></i>Add User
        </a>
    </div>
    
    <div style="overflow-x: auto;">
        <table class="table">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Link Assigned</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->is_admin)
                                <span style="background: #3b82f6; color: white; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.75rem;">ADMIN</span>
                            @else
                                <span style="background: #10b981; color: white; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.75rem;">USER</span>
                            @endif
                        </td>
                        <td>
                            @if($user->link)
                                <span style="color: #10b981;">{{ $user->link->slug }}</span>
                            @else
                                <span style="color: #ef4444;">No link</span>
                            @endif
                        </td>
                        <td>{{ $user->created_at->format('M j, Y') }}</td>
                        <td>
                            @if($user->id !== auth()->id())
                                <form method="POST" action="{{ route('admin.delete-user', $user->id) }}" style="display: inline;" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding: 0.5rem 1rem; font-size: 0.8rem;">
                                        <i class="fas fa-trash"></i>Delete
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="card">
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 2px solid #f8fafc;">
        <h4 style="margin: 0; color: #1e293b; font-weight: 700; font-size: 1.5rem; display: flex; align-items: center;">
            <i class="fas fa-link" style="margin-right: 0.75rem; color: #3b82f6; font-size: 1.25rem;"></i>Links Management
        </h4>
    </div>
    
    <div style="overflow-x: auto;">
        <table class="table">
            <thead>
                <tr>
                    <th>Slug</th>
                    <th>Owner</th>
                    <th>Visits</th>
                    <th>Buttons</th>
                    <th>Created</th>
                </tr>
            </thead>
            <tbody>
                @foreach($links as $link)
                    <tr>
                        <td>
                            <a href="{{ route('public.page', $link->slug) }}" target="_blank" style="color: #3b82f6; text-decoration: none;">
                                {{ $link->slug }}
                                <i class="fas fa-external-link-alt" style="font-size: 0.8rem; margin-left: 0.25rem;"></i>
                            </a>
                        </td>
                        <td>{{ $link->user->email }}</td>
                        <td>{{ $link->visit_count }}</td>
                        <td>{{ $link->buttons->count() }}</td>
                        <td>{{ $link->created_at->format('M j, Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const userSearch = document.getElementById('userSearch');
    const selectedUserId = document.getElementById('selectedUserId');
    let searchTimeout;

    userSearch.addEventListener('input', function() {
        const query = this.value.trim();
        
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            if (query.length >= 2) {
                searchUsers(query);
            }
        }, 300);
    });

    function searchUsers(query) {
        fetch(`{{ route('admin.search-users') }}?q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(users => {
                // Simple implementation - just set the first result
                if (users.length > 0) {
                    selectedUserId.value = users[0].id;
                }
            })
            .catch(error => {
                console.error('Search error:', error);
            });
    }
});
</script>
@endsection
