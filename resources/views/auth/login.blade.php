@extends('layouts.app')
@section('content')
<section>
    <div class="container">
        <div class="row login-warap">
            <div class="col-lg-6 col-10 order-lg-1 order-2">
                <div class="login-title">
                    <h1>Login</h1>
                    <p>Welcome back! please enter your details.</p>
                </div>
                <div class="login-info">
                    <form method="POST" action="{{ route('login') }}" class="pt-3">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="single-form">
                                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="single-form">
                                    <label for="exampleFormControlInput1" class="form-label">Password</label>
                                    <div class="password-wrapper">
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password" id="password">
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
                            <a href="{{ route('password.request') }}" class="forgot-text">Forgot Password?</a>
                            <div class="col-12">
                                <div class="single-btn">
                                    <button class="btn" role="button">Login</button>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="social-icon">
                                    <p>or</p>
                                    <a href="{{ route('google-login') }}">
                                        <svg width="88" height="88" viewBox="0 0 88 88" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g filter="url(#filter0_d_880_5780)">
                                                <circle cx="44" cy="44" r="20" fill="white" />
                                                <circle cx="44" cy="44" r="19.5" stroke="#1DA1F2" />
                                            </g>
                                            <path d="M37.6606 41.7494C38.5917 38.9279 41.2433 36.9015 44.384 36.9015C46.0722 36.9015 47.5971 37.5006 48.7953 38.4808L52.2808 34.9953C50.1568 33.1437 47.4338 32 44.384 32C39.6614 32 35.5953 34.6941 33.6406 38.6397L37.6606 41.7494Z" fill="#EA4335" />
                                            <path d="M48.4131 49.985C47.325 50.6876 45.9423 51.0616 44.3787 51.0616C41.25 51.0616 38.6067 49.0507 37.6661 46.2461L33.6328 49.3084C35.5851 53.261 39.651 55.9631 44.3787 55.9631C47.307 55.9631 50.1051 54.9221 52.2007 52.9674L48.4131 49.985Z" fill="#34A853" />
                                            <path d="M52.2049 52.9678C54.3964 50.9235 55.8196 47.8798 55.8196 43.9821C55.8196 43.2742 55.7107 42.5117 55.5473 41.8037H44.3828V46.4329H50.8092C50.4921 47.9895 49.6409 49.1953 48.4173 49.9854L52.2049 52.9678Z" fill="#4A90E2" />
                                            <path d="M37.6672 46.2457C37.429 45.5352 37.2999 44.7739 37.2999 43.9813C37.2999 43.2008 37.4251 42.4505 37.6565 41.7493L33.6365 38.6396C32.8343 40.2476 32.3984 42.0597 32.3984 43.9813C32.3984 45.8979 32.8425 47.7057 33.634 49.308L37.6672 46.2457Z" fill="#FBBC05" />
                                            <defs>
                                                <filter id="filter0_d_880_5780" x="0" y="0" width="88" height="88" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                                    <feOffset />
                                                    <feGaussianBlur stdDeviation="12" />
                                                    <feComposite in2="hardAlpha" operator="out" />
                                                    <feColorMatrix type="matrix" values="0 0 0 0 0.113725 0 0 0 0 0.631373 0 0 0 0 0.94902 0 0 0 0.2 0" />
                                                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_880_5780" />
                                                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_880_5780" result="shape" />
                                                </filter>
                                            </defs>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 col-10 order-lg-2 order-1">
                <div class="login-thumb">
                    <img src="{{ asset('web/images/Kids-Studying.png') }}" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
