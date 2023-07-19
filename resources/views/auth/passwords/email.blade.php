@extends('layouts.app')

@section('content')
<section>
    <div class="container">
        <div class="row login-warap">
            <div class="col-lg-6 col-10 order-lg-1 order-2">
                <div class="back-arrow">
                    <a href="{{ route('login') }}">
                        <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.165 6.91833L4.08337 14L11.165 21.0817" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M23.9166 14H4.28162" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
                <div class="login-title">
                    <h1>Forgot Password</h1>
                    <p>Please enter your registered email address.</p>
                </div>
                <div class="login-info">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="single-form">
                                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Enter your email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="single-btn">
                                    <input type="submit" class="btn" value="Send Reset Link">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 col-10 order-lg-2 order-1">
                <div class="login-thumb">
                    <img src="{{ asset('web/images/forgot-password-img.png') }}" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
