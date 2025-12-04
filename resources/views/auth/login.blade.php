@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="section balik-background">
    <div class="container" data-aos="fade-up">
        <div class="row justify-content-center align-items-center min-vh-100">
            <!--<div class="col-lg-6 d-flex align-items-center justify-content-center">
                <div class="content p-5">
                    <h2 class="fw-bold mb-4" style="color: white; font-size: 3rem;">Welcome to SIREFIS</h2>
                    <p class="mb-4" style="color: white; font-size: 1.2rem;">Your trusted platform for physiotherapy services. Login to access your personalized healthcare journey.</p>
                    <div class="d-flex gap-4">
                        <div class="icon-box" data-aos="zoom-in" data-aos-delay="100" style="background: rgba(255, 255, 255, 0.1);">
                            <i class="bi bi-heart-pulse" style="color: white;"></i>
                            <h4 style="color: white;">Expert Care</h4>
                            <p style="color: rgba(255, 255, 255, 0.8);">Professional physiotherapy services</p>
                        </div>
                    </div>
                </div>
            </div>-->

            <div class="col-lg-6">
                <div class="card shadow-lg" style="border-radius: 15px; background: rgba(255, 255, 255, 0.9);">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <img src="{{ URL::asset('assets/img/sirefislogo.png') }}" alt="Logo" style="width: 100px; height: 100px; border-radius: 50%; margin-bottom: 20px;">
                            <h2 class="fw-bold mb-0">Welcome Back!</h2>
                            <p class="text-muted">Please login to your account</p>
                        </div>

                        <form method="POST" action="{{ route('login.process') }}">

                            @csrf

                            <div class="form-group mb-4">
                                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}"
                                        required autocomplete="email" autofocus
                                        placeholder="Enter your email">
                                </div>
                                @error('email')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        name="password" required autocomplete="current-password"
                                        placeholder="Enter your password">
                                </div>
                                @error('password')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember"
                                            id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <a class="text-primary text-decoration-none" href="{{ route('password.request') }}">
                                            {{ __('Forgot Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <button type="submit" class="btn btn-primary w-100 py-2">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.section {
    min-height: 100vh;
    display: flex;
    align-items: center;
}

.card {
    backdrop-filter: blur(10px);
}

.input-group-text {
    background: transparent;
    border-right: none;
}

.form-control {
    border-left: none;
}

.form-control:focus {
    box-shadow: none;
    border-color: #ced4da;
}

.form-select {
    border-left: none;
    padding-left: 0;
}

.form-select:focus {
    box-shadow: none;
    border-color: #ced4da;
}

.btn-primary {
    background-color: #1977cc;
    border: none;
    font-weight: 600;
}

.btn-primary:hover {
    background-color: #166ab9;
}

.icon-box {
    padding: 30px;
    border-radius: 10px;
    width: 100%;
    text-align: center;
}

.icon-box i {
    font-size: 40px;
    margin-bottom: 15px;
}

@media (max-width: 991px) {
    .col-lg-6:first-child {
        display: none !important;
    }
}
</style>
@endsection
