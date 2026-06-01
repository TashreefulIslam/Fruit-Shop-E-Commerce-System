@extends('layouts.app')

@section('title', 'Edit Profile - Fruit Shop')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-lg border-0">
                <div class="card-header" style="background: linear-gradient(135deg, var(--primary-color), #ff8555); color: white; padding: 2rem;">
                    <h3 class="mb-0">
                        <i class="fas fa-user-edit me-2"></i>Edit Your Profile
                    </h3>
                </div>

                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Please fix the following errors:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Full Name</label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg @error('name') is-invalid @enderror"
                                   value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                                   value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4 p-3 bg-light rounded">
                            <p class="text-muted small mb-0">
                                <i class="fas fa-info-circle me-2"></i>
                                To change your password, please use the <a href="{{ route('password.request') }}">forgot password</a> option.
                            </p>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save me-2"></i>Save Changes
                            </button>
                            <a href="{{ route('profile.show') }}" class="btn btn-secondary btn-lg">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control-lg:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25);
    }
</style>
@endsection
