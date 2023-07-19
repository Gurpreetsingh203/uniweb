@extends('layouts.app')

@section('content')
<section>
    <div class="container">
        <div class="row login-warap">
            <div class="col-lg-6 col-10 order-lg-1 order-2">
                <div class="login-title">
                    <h1>Create Account</h1>
                    <p>For registration, please enter your details.</p>
                </div>
                <div class="login-info">

                    <!-- <div class="alert alert-danger alert-dismissible print-error-msg" style="display:none">
                        <ul>
                            <li></li>
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        </ul>
                    </div> -->




                    <form id="submitForm" method="POST" action="javascript:void(0)">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="single-form">
                                    <span for="exampleFormControlInput1" class="form-label">First Name</span>
                                    <input type="text" name="first_name" id="firstName" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" placeholder="First Name">
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="firstname-error-msg"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="single-form">
                                    <span for="exampleFormControlInput1" class="form-label">Last Name</span>
                                    <input type="text" name="last_name" id="lastName" class="form-control" value="{{ old('last_name') }}" placeholder="Last Name">
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="lastname-error-msg"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="single-form">
                                    <span for="exampleFormControlInput1" class="form-label">Email</span>
                                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="Email">
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="email-error-msg"></strong>
                                    </span>
                                </div>
                            </div>


                            <div class="col-12">
                                <div class="single-form">
                                    <span for="exampleFormControlInput1" class="form-label">Phone Number</span>
                                    <!-- <input type="number" name="contact" id="contact" class="form-control w-100" value="{{ old('contact') }}" placeholder="(xxx) xxx-xxxx" maxlength="15"> -->
                                    <input id="contact" type="tel" name="contact" placeholder="(XXX) XXX-XXXX" pattern="\(\d{3}\) \d{3}\-\d{4}" class="masked form-control" title="10-digit number">


                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong id="contact-error-msg"></strong>
                                    </span>
                                </div>
                            </div>



                            <!-- <div class="col-12">
                                <div class="single-form">
                                    <span for="exampleFormControlInput1" class="form-label">Phone
                                        Number</span>
                                    <div class="d-flex number-input">
                                        <input type="text" name="countryCode" id="countryCode" class="form-control" value="{{ old('country_code') }}" placeholder="+00" maxlength="4">
                                        <input type="number" name="contact" id="contact" class="form-control w-100" value="{{ old('contact') }}" placeholder="Phone Number" maxlength="15">

                                        <input type="tel" name="phoneW" id="phoneW" pattern="(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{4}" maxlength="14" title="US based Phone Number in the format of: (123) 456-7890" placeholder="(xxx) xxx-xxxx" required />

                                    </div>

                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong id="countrycode-error-msg"></strong>
                                    </span>

                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong id="contact-error-msg"></strong>
                                    </span>

                                </div>
                            </div> -->
                        </div>
                        <div class="col-12">
                            <div class="single-form">
                                <span for="exampleFormControlInput1" class="form-label">Password</span>
                                <div class="password-wrapper">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                    <i class="toggle-password fa fa-fw fa-eye-slash" id="eye"></i>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="password-error-msg"></strong>
                                    </span>

                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="single-form">
                                <span for="exampleFormControlInput1" class="form-label">Confirm
                                    Password</span>
                                <div class="password-wrapper">
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" id="confirmPassword">
                                    <i class="toggle-password fa fa-fw fa-eye-slash" id="eyes"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="single-btn">
                                <input type="submit" class="btn btn-submit" value="Create Account">
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
                    </form>
                </div>
            </div>
            <div class="col-lg-6 col-10 order-lg-2 order-1">
                <div class="login-thumb">
                    <img src="{{ asset('web/images/create-account-img.png') }}" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>





@endsection


@section('js')
<script>
    // $('.institution-body').css('display', 'block');
    // $('.institution-bg').fadeIn();
    // $('body').css('overflow', 'hidden');





    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $(".btn-submit").click(function(e) {
        e.preventDefault();

        var firstName = $("#firstName").val();
        var lastName = $("#lastName").val();
        var email = $("#email").val();
        var countryCode = $("#countryCode").val();
        var contact = $("#contact").val();
        var password = $("#password").val();
        var confirmPassword = $('#confirmPassword').val();

        $.ajax({
            type: "POST",
            url: "{{ route('create.student') }}",
            data: {
                first_name: firstName,
                last_name: lastName,
                email: email,
                country_code: countryCode,
                contact: contact,
                password: password,
                password_confirmation: confirmPassword
            },
            beforeSend: function() {
                $("#pageLoader").addClass("pageLoader");
            },
            success: function(data) {
                if ($.isEmptyObject(data.error)) {
                    $('.institution-body').css('display', 'block');
                    $('.institution-bg').fadeIn();
                    $('body').css('overflow', 'hidden');
                } else {
                    printErrorMsg(data.error);
                }
            },
            complete: function() {
                $("#pageLoader").removeClass("pageLoader");
            }
        });
    });

    function printErrorMsg(msg) {

        if (msg.first_name != undefined && msg.first_name[0]) {
            $('#firstName').addClass('is-invalid');
            $('#firstname-error-msg').text(msg.first_name[0]);
        } else {
            $('#firstName').removeClass('is-invalid');
            $('#firstname-error-msg').text('');
        }

        if (msg.last_name != undefined && msg.last_name[0]) {
            $('#lastName').addClass('is-invalid');
            $('#lastname-error-msg').text(msg.last_name[0]);
        } else {
            $('#lastName').removeClass('is-invalid');
            $('#lastname-error-msg').text('');
        }


        if (msg.email != undefined && msg.email[0]) {
            $('#email').addClass('is-invalid');
            $('#email-error-msg').text(msg.email[0]);
        } else {
            $('#email').removeClass('is-invalid');
            $('#email-error-msg').text('');
        }


        if (msg.country_code != undefined && msg.country_code[0]) {
            $('#countryCode').addClass('is-invalid');
            $('#countrycode-error-msg').text(msg.country_code[0]);
            $('.number-input').addClass('number-input-width');
        } else {
            $('#countryCode').removeClass('is-invalid');
            $('#countrycode-error-msg').text('');
            $('.number-input').removeClass('number-input-width');
        }


        if (msg.contact != undefined && msg.contact[0]) {
            $('#contact').addClass('is-invalid');
            $('#contact-error-msg').text(msg.contact[0]);
        } else {
            $('#contact').removeClass('is-invalid');
            $('#contact-error-msg').text('');
        }


        if (msg.password != undefined && msg.password[0]) {
            $('#password').addClass('is-invalid');
            $('#password-error-msg').text(msg.password[0]);
            $('#eye').hide();
        } else {
            $('#password').removeClass('is-invalid');
            $('#password-error-msg').text('');
            $('#eye').show();
        }

    }
</script>




@endsection
