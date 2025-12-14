@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="login-section">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-lg-6 col-md-8">
                <div class="card login-card shadow-lg">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <h2 class="fw-bold mb-0">Welcome Back!</h2>
                            <p class="text-muted">Please login to your account</p>
                        </div>

                        <form method="POST" action="{{ route('login.process') }}">
                            @csrf

                            <div class="mb-4">
                                <label for="email" class="form-label">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}"
                                        placeholder="Enter your email" required autofocus>
                                </div>
                                @error('email')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        name="password" placeholder="Enter your password" required>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                    <label class="form-check-label" for="remember">
                                        Remember Me
                                    </label>
                                </div>

                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-decoration-none">
                                        Forgot Password?
                                    </a>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2">
                                Login
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Background aman */
.login-section {
    min-height: 100vh;
    background: linear-gradient(135deg, #1977cc, #166ab9);
    display: flex;
    align-items: center;
}

/* Card */
.login-card {
    border-radius: 15px;
    background: rgba(255, 255, 255, 0.95);
}

/* Input */
.input-group-text {
    border-right: 0;
}

.form-control {
    border-left: 0;
}

.form-control:focus {
    box-shadow: none;
}

/* Button */
.btn-primary {
    background-color: #1977cc;
    border: none;
    font-weight: 600;
}

.btn-primary:hover {
    background-color: #166ab9;
}
</style>
@endsection
