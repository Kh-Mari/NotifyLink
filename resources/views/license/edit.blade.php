@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Edit License: {{ $license->license_key }}</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.license.update', $license) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="user" class="form-label">User Name</label>
                            <input id="user" type="text" class="form-control @error('user') is-invalid @enderror" 
                                   name="user" value="{{ old('user', $license->user) }}" required autofocus>
                            @error('user')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="expires" class="form-label">Expiration Date</label>
                            <input id="expires" type="date" class="form-control @error('expires') is-invalid @enderror" 
                                   name="expires" value="{{ old('expires', $license->expires->format('Y-m-d')) }}" required>
                            @error('expires')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Device ID</label>
                            <input type="text" class="form-control" value="{{ $license->device_id ?: 'Not activated' }}" readonly>
                            <small class="form-text text-muted">Device ID cannot be modified once set.</small>
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                Update License
                            </button>
                            <a href="{{ route('admin.license.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection