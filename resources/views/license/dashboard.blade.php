@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>License Admin Dashboard</h4>
                    <a href="{{ route('admin.license.create') }}" class="btn btn-success">Generate License</a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>License Key</th>
                                    <th>User</th>
                                    <th>Expires</th>
                                    <th>Device ID</th>
                                    <th>Activated At</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($licenses as $license)
                                    <tr>
                                        <td>
                                            <code>{{ $license->license_key }}</code>
                                        </td>
                                        <td>{{ $license->user }}</td>
                                        <td>{{ $license->expires->format('Y-m-d') }}</td>
                                        <td>{{ $license->device_id ?: '-' }}</td>
                                        <td>{{ $license->activated_at ? $license->activated_at->format('Y-m-d H:i') : '-' }}</td>
                                        <td>
                                            @if($license->isExpired())
                                                <span class="badge badge-danger">Expired</span>
                                            @elseif($license->isActivated())
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-warning">Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.license.edit', $license) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('admin.license.destroy', $license) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No licenses found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection