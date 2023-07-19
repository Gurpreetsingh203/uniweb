<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('web/images/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('web/images/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('web/images/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('web/images/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('web/images/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('web/images/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('web/images/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('web/images/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('web/images/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('web/images/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('web/images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('web/images/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('web/images/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('web/images/favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('web/images/favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">



    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- font online link start -->

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100&display=swap" rel="stylesheet">

    <!-- font online link End -->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />


    <link rel="stylesheet" href="{{ asset('web/css/style.css') }}">
    <title>{{ env('APP_NAME') }}</title>

    <style>
        .pageLoader {
            background: url('{{ asset("web/images/loading.gif") }}') no-repeat center center;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            z-index: 9999999;
            background-color: #ffffff8c;
        }
    </style>
</head>

<body>

    <div class="" id="pageLoader"></div>
    <!-- Header -->

    <header>
        <div class="header fixed">
            <div class="header-main">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="javascript:void(0)"><img src="{{ asset('web/images/uniweb-logo.png') }}" alt=""></a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">



                            @if (isset(auth()->user()->id))
                            <!-- {{ route('chat.index') }} -->
                            <a href="{{ route('chat.index') }}" class="d-flex align-items-center mx-4 my-3">
                                <div class="message-icon-wrap">
                                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.625 23.75H10C5 23.75 2.5 22.5 2.5 16.25V10C2.5 5 5 2.5 10 2.5H20C25 2.5 27.5 5 27.5 10V16.25C27.5 21.25 25 23.75 20 23.75H19.375C18.9875 23.75 18.6125 23.9375 18.375 24.25L16.5 26.75C15.675 27.85 14.325 27.85 13.5 26.75L11.625 24.25C11.425 23.975 10.9625 23.75 10.625 23.75Z" stroke="#1DA1F2" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M8.75 10H21.25" stroke="#1DA1F2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M8.75 16.25H16.25" stroke="#1DA1F2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>


                                    @php
                                    $pendingChatCount = App\Models\Chat::select('sender_id')->whereReceiverId(auth()->user()->id)->whereSeen(0)->get();
                                    @endphp

                                    @if (count($pendingChatCount) > 0)
                                    <span class="position-absolute translate-middle badge rounded-pill bg-primary direct-message-count-static">
                                        {{ count($pendingChatCount) }}
                                    </span>
                                    @endif

                                    <span class="position-absolute translate-middle badge rounded-pill bg-primary direct-message-count">
                                    </span>





                                </div>
                                <p>&nbspDirect Message</p>
                            </a>

                            <form class="d-flex align-items-center">
                                <div class="user-profile">
                                    <div class="user-info d-flex align-items-center justify-content-between">





                                        <a href="#!" class="d-flex align-items-center">
                                            @if (isset(auth()->user()->profile) && auth()->user()->profile!="")
                                            <img src="{{ fullImgUrl(auth()->user()->profile) }}" class="header-profile">
                                            @else
                                            <img src="{{ asset('web/images/placeorder.png') }}" class="header-profile">
                                            @endif

                                            <p> {{ auth()->user()->first_name.' '.auth()->user()->last_name }} </p>
                                            <i class="fa-solid fa-angle-down"></i>
                                        </a>
                                    </div>
                                    <ul class="profile-menu position-absolute">
                                        <li>
                                            <div class="d-flex profile-header align-items-center position-relative">

                                                @if (isset(auth()->user()->profile) && auth()->user()->profile!="")
                                                <img src="{{ fullImgUrl(auth()->user()->profile) }}" alt="" class="header-profile">
                                                @else
                                                <img src="{{ asset('web/images/placeorder.png') }}" alt="" class="header-profile">
                                                @endif


                                                <span class="d-block">
                                                    <h5 id="content">{{ auth()->user()->first_name.' '.auth()->user()->last_name }}</h5>
                                                    <a href="companies.html" class="d-block">{{ auth()->user()->email }}</a>
                                                </span>
                                                <a href="#!" class="edit_profile">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M13.2603 3.59997L5.05034 12.29C4.74034 12.62 4.44034 13.27 4.38034 13.72L4.01034 16.96C3.88034 18.13 4.72034 18.93 5.88034 18.73L9.10034 18.18C9.55034 18.1 10.1803 17.77 10.4903 17.43L18.7003 8.73997C20.1203 7.23997 20.7603 5.52997 18.5503 3.43997C16.3503 1.36997 14.6803 2.09997 13.2603 3.59997Z" stroke="#1DA1F2" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M11.8896 5.05005C12.3196 7.81005 14.5596 9.92005 17.3396 10.2" stroke="#1DA1F2" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M3 22H21" stroke="#1DA1F2" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </li>
                                        <!--
                                        <li>
                                            <div class="d-flex profile-header align-items-center position-relative">
                                                <span class="d-block">
                                                    Zoom crenditials
                                                </span>
                                                <a href="#!" class="edit_profile">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M13.2603 3.59997L5.05034 12.29C4.74034 12.62 4.44034 13.27 4.38034 13.72L4.01034 16.96C3.88034 18.13 4.72034 18.93 5.88034 18.73L9.10034 18.18C9.55034 18.1 10.1803 17.77 10.4903 17.43L18.7003 8.73997C20.1203 7.23997 20.7603 5.52997 18.5503 3.43997C16.3503 1.36997 14.6803 2.09997 13.2603 3.59997Z" stroke="#1DA1F2" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M11.8896 5.05005C12.3196 7.81005 14.5596 9.92005 17.3396 10.2" stroke="#1DA1F2" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M3 22H21" stroke="#1DA1F2" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </li> -->


                                        <li>
                                            <a href="#!" class="text-end d-block sign_out">
                                                Logout
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M15.0996 16.44C14.7896 20.04 12.9396 21.51 8.88961 21.51L8.75961 21.51C4.28961 21.51 2.49961 19.72 2.49961 15.25L2.49961 8.73001C2.49961 4.26001 4.28961 2.47001 8.75961 2.47001L8.88961 2.47001C12.9096 2.47001 14.7596 3.92001 15.0896 7.46001" stroke="#1DA1F2" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M8.99988 12L20.3799 12" stroke="#1DA1F2" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M18.15 15.35L21.5 12L18.15 8.64997" stroke="#1DA1F2" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="feedback-icon">
                                    <a href="#!">
                                        <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g filter="url(#filter0_d_806_7359)">
                                                <circle cx="30" cy="27" r="20" fill="#1DA1F2" />
                                            </g>
                                            <g clip-path="url(#clip0_806_7359)">
                                                <path d="M31.5859 26.9354C31.9355 26.9354 32.1953 26.6522 32.1953 26.3261C32.1953 25.9784 31.9121 25.7167 31.5859 25.7167H23.834C23.4863 25.7167 23.2246 25.9999 23.2246 26.3261C23.2246 26.6737 23.5078 26.9354 23.834 26.9354H31.5859ZM34.127 18.8534L37.6621 15.1151C37.7969 15.0018 37.9336 14.9569 38.0918 15.0468L40.9355 17.8007C41.0488 17.9354 41.0703 18.0936 40.9121 18.2518L37.3105 22.0585L34.127 18.8534ZM36.1367 23.2558L32.4922 24.0097L32.9531 20.0487L36.1367 23.2558ZM22.7383 17.5565H30.8887L30.293 18.8163H22.7383C22.0586 18.8163 21.4395 19.0956 20.9883 19.5448C20.5371 19.994 20.2598 20.6112 20.2598 21.2948V30.2284C20.2598 30.9081 20.5391 31.5292 20.9883 31.9784C21.4375 32.4276 22.0566 32.7069 22.7383 32.7069H23.4648V32.7089L23.5059 32.7108C23.8516 32.7343 24.1152 33.0351 24.0898 33.3808L23.8438 36.9159L28.5273 34.0819C28.6406 33.9686 28.7969 33.9003 28.9707 33.9003H36.2598C36.9395 33.9003 37.5586 33.6229 38.0098 33.1718C38.459 32.7226 38.7383 32.1015 38.7383 31.4218V24.8534H40.043V33.1913C40.1113 35.0722 39.3438 36.1288 36.248 36.2577L29.9492 36.1132L23.5566 38.8222L23.5254 38.8476C23.2617 39.0741 22.8652 39.0429 22.6387 38.7772C22.5273 38.6464 22.4785 38.4862 22.4883 38.328L22.791 33.9647H22.7402C21.7129 33.9647 20.7773 33.5448 20.0996 32.8671C19.4199 32.1933 19 31.2577 19 30.2304V21.2948C19 20.2675 19.4199 19.3319 20.0977 18.6542C20.7734 17.9765 21.709 17.5565 22.7383 17.5565ZM34.5645 30.3163C34.9141 30.3163 35.1738 30.0331 35.1738 29.7069C35.1738 29.3573 34.8906 29.0976 34.5645 29.0976H23.834C23.4863 29.0976 23.2246 29.3808 23.2246 29.7069C23.2246 30.0546 23.5078 30.3163 23.834 30.3163H34.5645ZM28.8418 23.5565C29.1895 23.5565 29.4512 23.2733 29.4512 22.9472C29.4512 22.621 29.168 22.3378 28.8418 22.3378H23.834C23.4863 22.3378 23.2246 22.621 23.2246 22.9472C23.2246 23.2948 23.5078 23.5565 23.834 23.5565H28.8418Z" fill="white" />
                                            </g>
                                            <defs>
                                                <filter id="filter0_d_806_7359" x="0" y="0" width="60" height="60" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                                    <feOffset dy="3" />
                                                    <feGaussianBlur stdDeviation="5" />
                                                    <feColorMatrix type="matrix" values="0 0 0 0 0.113725 0 0 0 0 0.631373 0 0 0 0 0.94902 0 0 0 0.35 0" />
                                                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_806_7359" />
                                                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_806_7359" result="shape" />
                                                </filter>
                                                <clipPath id="clip0_806_7359">
                                                    <rect width="22.0254" height="24" fill="white" transform="translate(19 15)" />
                                                </clipPath>
                                            </defs>
                                        </svg>

                                    </a>
                                </div>


                            </form>
                            @else
                            <form class="d-flex">
                                <div class="user-profile position-relative">
                                    <div class="user-info ">
                                        <div class="d-flex align-items-center profile">

                                            @if (request()->segment(1) == 'register')
                                            <p>Already have an account?</p>
                                            <a class="mx-3" href="{{ route('login') }}">Login</a>
                                            @else
                                            <p>Don’t have an account?</p>
                                            <a class="mx-3" href="{{ route('register') }}">Create Account</a>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </form>
                            @endif



                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <!---------------------------->

    @yield('content')


    <!-- ---------------- -->

    <!-- Footer -->

    <section class="footer">
        <div class="all-right w-100 text-center">
            <p>All rights reserved to uniwebs.io © 2022</p>
            <!-- <span class="">
                Developed by
                <a href="https://iroidsolutions.com/"><b>iRoid Solutions</b></a>
            </span> -->
        </div>
    </section>

    <!--  -->



    @if (isset(auth()->user()->id))
    <!-- Update Profile popup section start-->
    <div class="profile-bg update_profile">
        <div class="profile-body d-flex align-items-center">
            <form id="updateProfile" method="post" enctype="multipart/form-data">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-10">
                        <div class="profile-thumb">

                            <h1>Update Profile</h1>
                            <div class="circle">
                                @if (isset(auth()->user()->profile) && auth()->user()->profile!="")
                                <img class="profile-pic" src="{{ fullImgUrl(auth()->user()->profile) }}">
                                @else
                                <img class="profile-pic" src="{{ asset('web/images/placeorder.png') }}">
                                @endif
                                <div class="p-image">
                                    <i class="fa fa-camera upload-button"></i>
                                    <input class="file-upload" name="profile" id="profile" type="file" accept="image/*" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="profile-info">
                            <span class="invalid-feedback" role="alert" style="display: block;">
                                <strong id="profile-error-msg"></strong>
                            </span>
                            <div class="row">
                            <a href="https://developers.zoom.us/docs/platform/build/jwt-app/" target="_blank" style="color: #0d6efd;">How to create app on zoom? please click here</a>
                                <div class="col-12">
                                    <div class="single-form">
                                        <label for="exampleFormControlInput1" class="form-label">First Name</label>
                                        <input type="text" name="first_name" id="firstName" class="form-control" value="{{ auth()->user()->first_name }}" placeholder="First Name">
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="firstname-error-msg"></strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="single-form">
                                        <label for="exampleFormControlInput1" class="form-label">Last Name</label>
                                        <input type="text" name="last_name" id="lastName" class="form-control" value="{{ auth()->user()->last_name }}" placeholder="Last Name">
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="lastname-error-msg"></strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="single-form">
                                        <label for="exampleFormControlInput1" class="form-label">Email</label>
                                        <input type="text" name="email" id="email" class="form-control" value="{{ auth()->user()->email }}" placeholder="Email">
                                        <span class="invalid-feedback" role="alert" style="display: block;">
                                            <strong id="email-error-msg"></strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="single-form">
                                        <span for="exampleFormControlInput1" class="form-label">Phone Number</span>
                                        <!-- <input type="number" name="contact" id="contact" class="form-control w-100" value="{{ auth()->user()->contact }}" placeholder="(xxx) xxx-xxxx" maxlength="15"> -->
                                        <input id="tel" type="tel" name="contact" placeholder="(XXX) XXX-XXXX" pattern="\(\d{3}\) \d{3}\-\d{4}" class="masked form-control" value="{{ auth()->user()->contact }}" title="10-digit number">

                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong id="contact-error-msg"></strong>
                                        </span>
                                    </div>
                                </div>




                                <div class="col-12">
                                    <div class="single-form">
                                        <label for="exampleFormControlInput1" class="form-label">Zoom client id(<b>API key</b>)</label>
                                        <input type="text" name="zoom_client_id" id="zoomClientId" class="form-control" value="{{ auth()->user()->zoom_client_id }}" placeholder="xxxxxxxxxxxxxxx">
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="zoomClientId-error-msg"></strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="single-form">
                                        <label for="exampleFormControlInput1" class="form-label">Zoom secret key(<b>API Secret</b>)</label>
                                        <input type="text" name="zoom_client_secret_key" id="zoomClientSecret" class="form-control" value="{{ auth()->user()->zoom_client_secret_key }}" placeholder="xxxxxxxxxxxxxx">
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="zoomClientSecret-error-msg"></strong>
                                        </span>
                                    </div>
                                </div>



                                <!-- <div class="col-12">
                                    <div class="single-form">
                                        <label for="exampleFormControlInput1" class="form-label">Phone
                                            Number</label>
                                        <div class="d-flex number-input">
                                            <input type="text" name="country_code" id="countryCode" class="form-control" value="{{ auth()->user()->country_code }}" placeholder="+00" maxlength="4">
                                            <input type="number" name="contact" id="contact" class="form-control w-100" value="{{ auth()->user()->contact }}" placeholder="Phone Number" maxlength="15">
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

                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-9 col-12">
                            <div class="profile-btn">
                                <a class="btn remove-edit" href="{{ Request::url(); }}" role="button">Cancel</a>
                                <input type="submit" class="btn btn-submit" value="Save">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Update Profile popup section End-->


    <!-- log-out popup section start-->
    <div class="log-out-bg log_out">
        <div class="log-out-body">
            <div class="log-out-info">
                <h3 class="text-center">Are you sure you want to Logout?</h3>
                <div class="log-out-btn">
                    <a href="{{ Request::url(); }}" class="btn modal-close cancel-btn">Cancel</a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn delete">Logout</a>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
    <!-- log-out popup section End-->




    <!-- Feedback -->
    <div class="profile-bg feeback">
        <div class="profile-body d-flex align-items-center">
            <form id="feedbackSubmit" method="post" enctype="multipart/form-data">
                <div class="row justify-content-center">
                    <!-- <div class="col-lg-6 col-10">
                        <div class="profile-thumb">


                            <div class="circle">
                                @if (isset(auth()->user()->profile) && auth()->user()->profile!="")
                                <img class="profile-pic" src="{{ fullImgUrl(auth()->user()->profile) }}">
                                @else
                                <img class="profile-pic" src="{{ asset('web/images/placeorder.png') }}">
                                @endif
                                <div class="p-image">
                                    <i class="fa fa-camera upload-button"></i>
                                    <input class="file-upload" name="profile" id="profile" type="file" accept="image/*" />
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-lg-12 col-12">


                        <div class="profile-info">
                            <h3>Feedback</h3>
                            <div class="row">
                                <div class="col-12">
                                    <div class="single-form">
                                        <label for="exampleFormControlInput1" class="form-label">Subject</label>
                                        <input type="text" name="subject" id="subject" class="form-control" value="" placeholder="Subject">
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="subject-error-msg"></strong>
                                        </span>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="single-form">
                                        <label for="exampleFormControlInput1" class="form-label">Attachment</label>
                                        <input type="file" name="attachment[]" id="subject" class="form-control" value="" multiple>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="subject-error-msg"></strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="single-form">
                                        <label for="exampleFormControlInput1" class="form-label">Comment</label>
                                        <textarea name="comment" class="form-control" id="comment" cols="30" rows="10"></textarea>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="comment-error-msg"></strong>
                                        </span>
                                    </div>
                                </div>

                                <!-- <div class="col-12">
                                    <div class="single-form">
                                        <label for="exampleFormControlInput1" class="form-label">Priority</label>
                                        <select name="priority" class="form-control" id="priority">
                                            <option value="">Select Priority</option>
                                            <option value="low">Low</option>
                                            <option value="normal">Normal</option>
                                            <option value="high">High</option>
                                            <option value="urgent">Urgent</option>
                                        </select>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="priority-error-msg"></strong>
                                        </span>
                                    </div>
                                </div> -->


                            </div>

                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-9 col-12">
                            <div class="profile-btn">
                                <a class="btn remove-edit" href="{{ Request::url(); }}" role="button">Cancel</a>
                                <input type="submit" class="btn btn-submit" value="Save">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Feedback -->
    @endif


    <!-- Select Institution popup section start-->
    <div class="institution-bg select-institute"></div>
    <div class="institution-body">
        <div class="d-lg-flex align-items-center">
            <div class="col-lg-6 col-12 d-lg-flex align-items-center">
                <div class="modal-thumb">
                    <img src="{{ asset('web/images/univercity.png') }}" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <div class="institution-info">
                    <div class="institution-title">
                        <h1>Select Your Institution</h1>
                        <p>Please enter the name of your institution</p>
                    </div>
                    <div class="institution-form">
                        <form method="GET" action="javascript:void(0)">
                            <div class="row">
                                <div class="col-12">
                                    <div class="single-form">
                                        <label for="exampleFormControlInput1" class="form-label">Search for your institution</label>
                                        <input type="text" name="name" id="search" class="form-control" placeholder="e.g. Stanford University" required>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="search-error-msg"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="single-btn">
                                        <!-- <button class="btn go-next" id="go-next">Next</button> -->

                                        <input type="submit" class="btn go-next" id="go-next" value="Next">
                                        <!-- <a class="btn go-next" href="#!" id="go-next" role="button">Next</a> -->
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Select Institution popup section End-->


    <!-- Select Courses popup section start-->
    <div class="courses-bg slct-cource"></div>
    <div class="courses-body">
        <div class="d-lg-flex align-items-center">

            <div class="courses-thumb">
                <!-- <a href="{{ url('') }}"> -->
                <i class="fa-solid fa-arrow-left back-arrow go-next" onclick="refreshPage()"></i>
                <!-- </a> -->
                <img src="{{ asset('web/images/select-courses.png') }}" class="img-fluid">
            </div>



            <div class="courses-wrap">
                <div class="courses-title">
                    <h1>Select Your Courses</h1>
                </div>
                <div class="courses-info">
                    <form action="{{ route('school-group-member.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <ul id="schoolGroups">

                                </ul>
                            </div>
                            <div class="col-12">
                                <div class="single-btn">
                                    <input type="submit" class="btn join-course" id="joinCourse" value="Join the Course">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Select Courses popup section End-->

    <!-- JS Links -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.18/vue.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>


    <script src="{{ asset('web/js/custom.js') }}"></script>

    @if (isset(auth()->user()->id))
    <script src="{{ asset('js/enable-push.js') }}"></script>
    @endif

    <!--StartofuniwebshelpZendeskWidgetscript-->
    <scriptid="ze-snippet" src="https: //static.zdassets.com/ekr/snippet.js?key=6c76a32e-2c9a-49d0-9613-ad0cb5028974"></script>
        <!--EndofuniwebshelpZendeskWidgetscript-->

        <script>
            function validate(input) {
                if (/^\s/.test(input.value))
                    input.value = '';
            }
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('student-register-status') }}",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if (data.status == false) {
                            $('.institution-body').css('display', 'block');
                            $('.institution-bg').fadeIn();
                            $('body').css('overflow', 'hidden');
                        }
                    },
                    error: function(data) {
                        console.log(data);
                    },
                });
            });
        </script>


        <script>
            $(document).ready(function() {
                toastr.options.timeOut = 10000;
                $(document).ready(function() {
                    @if(Session::has('error'))
                    toastr.error("{{ (Session::get('error')) }}");
                    @elseif(Session::has('success'))
                    toastr.success("{{ Session::get('success') }}");
                    @endif
                });
            });
        </script>


        <script type="text/javascript">
            var route = "{{ route('search-school') }}";
            // $(".go-next").prop("disabled", true);
            $('#search').typeahead({
                source: function(query, process) {
                    return $.get(route, {
                        query: query
                    }, function(data) {
                        if (data == '') {
                            // console.log('false');
                            // $("#go-next").prop("disabled", true);
                            return process('');
                        } else {
                            console.log(data);
                            // $("#go-next").prop("disabled", false);
                            return process(data);
                        }
                    });
                }
            });
        </script>

        <script>
            $('.go-next').click(function(e) {
                e.preventDefault();
                var school = $('#search').val()
                var name = $('#search').val()
                $.ajax({
                    type: "GET",
                    url: "{{ route('groups-of-school') }}",
                    data: {
                        school: school,
                        name: name
                    },
                    success: function(data) {
                        if ($.isEmptyObject(data.error)) {
                            $('.courses-body').css('display', 'block');
                            $('.institution-body').fadeOut();
                            $('.courses-bg').fadeIn();
                            $('body').css('overflow', 'hidden');
                            $('#schoolGroups').html(data);
                        } else {
                            printSearchSchoolErrorMsg(data.error);
                        }
                    },
                });

            })

            function printSearchSchoolErrorMsg(msg) {

                if (msg.name != undefined && msg.name[0]) {
                    // $('.institution-bg select-institute').removeClass('display','block');
                    $('#search').addClass('is-invalid');
                    $('#search-error-msg').text(msg.name[0]);
                } else {
                    // $('.institution-bg select-institute').removeClass('display','block');
                    $('#search').removeClass('is-invalid');
                    $('#search-error-msg').text('');
                }

            }
        </script>

        <script>
            $(document).ready(function() {
                $('#joinCourse').click(function() {
                    checked = $("input[type=checkbox]:checked").length;

                    if (!checked) {
                        toastr.error("You must check at least one group.");
                        // alert("You must check at least one group.");
                        return false;
                    }

                });
            });
        </script>

        <!-- Join the course -->
        <script>
            // $('.join-course').click(function(e) {
            //     alert('join-course');
            //     e.preventDefault();
            //     var group = $('#group').val()
            //     $.ajax({
            //         type: "POST",
            //         url: "{{ route('school-group-member.store') }}",
            //         data: {
            //             group: group
            //         },
            //         success: function(data) {
            //             if ($.isEmptyObject(data.error)) {
            //                 location.reload();
            //             } else {
            //                 printJoinCourseErrorMsg(data.error);
            //             }
            //         },
            //     });

            // })

            // function printJoinCourseErrorMsg(msg) {

            //     if (msg.group != undefined && msg.group[0]) {
            //         $('#search').addClass('is-invalid');
            //         $('#search-error-msg').text(msg.group[0]);
            //     } else {
            //         $('#search').removeClass('is-invalid');
            //         $('#search-error-msg').text('');
            //     }

            // }
        </script>

        <script>
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            $(document).ready(function() {
                $('#updateProfile').on('submit', function(event) {
                    event.preventDefault();
                    $.ajax({
                        url: "{{ route('edit.profile') }}",
                        method: "POST",
                        data: new FormData(this),
                        dataType: 'JSON',
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function() {
                            $("#pageLoader").addClass("pageLoader");
                        },
                        success: function(data) {
                            if ($.isEmptyObject(data.error)) {
                                $('.update_profile').fadeOut();
                                $('html').css('overflow', 'hidden');
                                location.reload();
                            } else {
                                printProfileErrorMsg(data.error);
                            }
                        },
                        complete: function() {
                            $("#pageLoader").removeClass("pageLoader");
                        }
                    })
                });

            });


            function printProfileErrorMsg(msg) {

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


                if (msg.zoom_client_id != undefined && msg.zoom_client_id[0]) {
                    $('#zoomClientId').addClass('is-invalid');
                    $('#zoomClientId-error-msg').text(msg.zoom_client_id[0]);
                } else {
                    $('#zoomClientId').removeClass('is-invalid');
                    $('#zoomClientId-error-msg').text('');
                }


                if (msg.zoom_client_secret_key != undefined && msg.zoom_client_secret_key[0]) {
                    $('#zoomClientSecret').addClass('is-invalid');
                    $('#zoomClientSecret-error-msg').text(msg.zoom_client_secret_key[0]);
                } else {
                    $('#zoomClientSecret').removeClass('is-invalid');
                    $('#zoomClientSecret-error-msg').text('');
                }




                if (msg.profile != undefined && msg.profile[0]) {
                    // alert(msg.profile);
                    // $('#contact').addClass('is-invalid');
                    $('#profile-error-msg').text(msg.profile[0]);

                    // toastr.error(msg.contact[0]);
                    // return false;
                }

            }




            $(document).ready(function() {
                $('#feedbackSubmit').on('submit', function(event) {
                    event.preventDefault();
                    $.ajax({
                        url: "{{ route('zendesk.store') }}",
                        method: "POST",
                        data: new FormData(this),
                        dataType: 'JSON',
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function() {
                            $("#pageLoader").addClass("pageLoader");
                        },
                        success: function(data) {
                            if ($.isEmptyObject(data.error)) {
                                $('.feeback').fadeOut();
                                $('html').css('overflow', 'hidden');
                                $("#feedbackSubmit")[0].reset();
                                toastr.success("Feedback send successfully. admin get back to you soon.");
                                // location.reload();
                            } else {
                                printFeedbackErrorMsg(data.error);
                            }
                        },
                        complete: function() {
                            $("#pageLoader").removeClass("pageLoader");
                        }
                    })
                });

            });


            function printFeedbackErrorMsg(msg) {
                if (msg.subject != undefined && msg.subject[0]) {
                    $('#subject').addClass('is-invalid');
                    $('#subject-error-msg').text(msg.subject[0]);
                } else {
                    $('#subject').removeClass('is-invalid');
                    $('#subject-error-msg').text('');
                }

                if (msg.comment != undefined && msg.comment[0]) {
                    $('#comment').addClass('is-invalid');
                    $('#comment-error-msg').text(msg.comment[0]);
                } else {
                    $('#comment').removeClass('is-invalid');
                    $('#comment-error-msg').text('');
                }

                if (msg.priority != undefined && msg.priority[0]) {
                    $('#priority').addClass('is-invalid');
                    $('#priority-error-msg').text(msg.priority[0]);
                } else {
                    $('#priority').removeClass('is-invalid');
                    $('#priority-error-msg').text('');
                }
            }
        </script>



        <script>
            $(".direct-message-count").hide();

            function updateNotificationCount() {
                $.ajax({
                    url: "{{ route('direct-message-count') }}",
                    success: function(data) {
                        // alert(data);
                        if (data != 0) {
                            $(".direct-message-count").show();
                            $(".direct-message-count").text(data);
                        }
                    }
                });
            }

            setInterval(function() {
                updateNotificationCount();
                updateUserStatus();
            }, 3000);



            $('.user-status').hide();
            $('.pending-chat-count').hide();

            function updateUserStatus() {
                var group = '{{ Request::segment(2); }}';
                // alert(group);
                $.ajax({
                    url: "{{ route('user-status') }}",
                    data: {
                        group: group
                    },
                    success: function(data) {
                        jQuery.each(data, function(index, itemData) {
                            // console.log(itemData.id);
                            if (itemData.status == true) {
                                $('.user-status-static').hide();
                                $('.user-status').show();
                                // console.log('alert-true' + itemData.id);
                                $('.user-status-' + itemData.id).removeClass('bg-danger');
                                $('.user-status-' + itemData.id).addClass('bg-success');
                            } else {
                                $('.user-status-static').hide();
                                $('.user-status').show();
                                // console.log('alert-false' + itemData.id);
                                $('.user-status-' + itemData.id).removeClass('bg-success');
                                $('.user-status-' + itemData.id).addClass('bg-danger');
                            }
                            $('.pending-chat-count-static').hide();


                            if (itemData.pending_chat_count != 0) {
                                $('.pending-chat-count').show();
                                // console.log('.pending-chat-count-pass' + itemData.id);
                                $('.pending-chat-count-' + itemData.id).text(itemData.pending_chat_count);
                            } else {
                                // console.log('.pending-chat-count-fail' + itemData.id);
                                $('.pending-chat-count-' + itemData.id).hide();
                            }



                        });
                    }
                });



                var subgroup = '{{ Request::segment(3); }}';
                $.ajax({
                    url: "{{ route('group-chat-user-status') }}",
                    data: {
                        subgroup: subgroup
                    },
                    success: function(data) {
                        jQuery.each(data, function(index, itemData) {
                            // console.log(itemData.id);
                            if (itemData.status == true) {
                                $('.user-status-static').hide();
                                $('.user-status').show();
                                // console.log('alert-true' + itemData.id);
                                $('.user-status-' + itemData.id).removeClass('bg-danger');
                                $('.user-status-' + itemData.id).addClass('bg-success');
                            } else {
                                $('.user-status-static').hide();
                                $('.user-status').show();
                                // console.log('alert-false' + itemData.id);
                                $('.user-status-' + itemData.id).removeClass('bg-success');
                                $('.user-status-' + itemData.id).addClass('bg-danger');
                            }
                            $('.pending-chat-count-static').hide();

                            if (itemData.pending_chat_count != 0) {
                                $('.pending-chat-count').show();

                                // console.log('.pending-chat-count-pass' + itemData.id);
                                $('.pending-chat-count-' + itemData.id).text(itemData.pending_chat_count);
                            } else {
                                // console.log('.pending-chat-count-fail' + itemData.id);
                                $('.pending-chat-count-' + itemData.id).hide();
                            }

                        });
                    }
                });


                $.ajax({
                    url: "{{ route('chat-user-status') }}",
                    success: function(data) {
                        jQuery.each(data, function(index, itemData) {
                            // console.log(itemData.id);
                            if (itemData.status == true) {
                                $('.user-status-static').hide();
                                $('.user-status').show();
                                // console.log('alert-true' + itemData.id);
                                $('.user-status-' + itemData.id).removeClass('bg-danger');
                                $('.user-status-' + itemData.id).addClass('bg-success');
                            } else {
                                $('.user-status-static').hide();
                                $('.user-status').show();
                                // console.log('alert-false' + itemData.id);
                                $('.user-status-' + itemData.id).removeClass('bg-success');
                                $('.user-status-' + itemData.id).addClass('bg-danger');
                            }
                            $('.pending-chat-count-static').hide();


                            if (itemData.pending_chat_count != 0) {
                                $('.pending-chat-count').show();
                                // console.log('.pending-chat-count-pass' + itemData.id);
                                $('.pending-chat-count-' + itemData.id).text(itemData.pending_chat_count);
                            } else {
                                // console.log('.pending-chat-count-fail' + itemData.id);
                                $('.pending-chat-count-' + itemData.id).hide();
                            }

                        });
                    }
                });



            }
        </script>


        <script type="text/javascript">
            const SITE_URL = "{{ url('/') }}";
        </script>


        @yield('js')

</body>

</html>
