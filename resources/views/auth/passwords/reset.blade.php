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
                    <h1>Reset Password</h1>
                </div>
                <div class="login-info">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="row">
                            <div class="col-12">
                                <div class="single-form">
                                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $email ?? old('email') }}" placeholder="Enter your email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <div class="single-form">
                                        <label for="exampleFormControlInput1" class="form-label">Password</label>
                                        <div class="password-wrapper">
                                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" id="password">
                                            <!-- <i class="toggle-password fa fa-fw fa-eye-slash" id="eye"></i> -->

                                            @if(!$errors->has('password'))
                                            <i class="toggle-password fa fa-fw fa-eye-slash" id="eye"></i>
                                            @endif
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="single-form">
                                        <label for="exampleFormControlInput1" class="form-label">Confirm
                                            Password</label>
                                        <div class="password-wrapper">
                                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" id="passwords">
                                            <i class="toggle-password fa fa-fw fa-eye-slash" id="eyes"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="single-btn">
                                    <input type="submit" class="btn" value="Submit">
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
