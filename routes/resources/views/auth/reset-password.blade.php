@extends('layouts.app')

@section('title', 'Reset Password - Fruit Shop')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-dark">Create New Password</h2>
                        <p class="text-muted">Enter your new password below</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                                   placeholder="Enter your email" value="{{ $request->email ?? old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">New Password</label>
                            <input type="password" name="password" id="password" class="form-control form-control-lg @error('password') is-invalid @enderror"
                                   placeholder="Enter your new password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted d-block mt-1">
                                <i class="fas fa-info-circle"></i> At least 8 characters, including uppercase, lowercase, numbers & symbols
                            </small>
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-semibold">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror"
                                   placeholder="Confirm your new password" required>
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-lg w-100" style="background: linear-gradient(135deg, var(--primary-color), #ff8555); color: white; border: none;">
                            <i class="fas fa-lock me-2"></i> Reset Password
                        </button>
                    </form>

                    <hr class="my-4">

                    <p class="text-center">
                        <a href="{{ route('login') }}" class="text-muted">Back to login</a>
                    </p>
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
