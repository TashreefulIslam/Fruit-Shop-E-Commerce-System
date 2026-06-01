@extends('layouts.app')

@section('title', 'Login - Fruit Shop')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-dark">Welcome Back</h2>
                        <p class="text-muted">Sign in to your account</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Login Failed!</strong>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                   placeholder="Enter your email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <input type="password" name="password" id="password" class="form-control form-control-lg @error('password') is-invalid @enderror"
                                   placeholder="Enter your password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" id="remember" class="form-check-input">
                            <label for="remember" class="form-check-label">Remember me</label>
                        </div>

                        <button type="submit" class="btn btn-lg w-100" style="background: linear-gradient(135deg, var(--primary-color), #ff8555); color: white; border: none;">
                            <i class="fas fa-sign-in-alt me-2"></i> Sign In
                        </button>
                    </form>

                    <hr class="my-4">

                    <p class="text-center text-muted mb-0">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="fw-semibold" style="color: var(--primary-color);">Create one</a>
                    </p>

                    <p class="text-center mt-3">
                        <a href="{{ route('password.request') }}" class="text-muted small">Forgot your password?</a>
                    </p>

                    <!-- Test Credentials -->
                    <div class="mt-4 p-3 bg-light rounded">
                        <p class="small text-muted mb-2"><strong>Test Credentials:</strong></p>
                        <p class="small mb-1"><strong>Admin:</strong> admin@fruitshop.com / admin123</p>
                        <p class="small mb-0"><strong>User:</strong> john@example.com / password</p>
                    </div>
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
