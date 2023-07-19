@extends('layouts.app')


@section('content')


<!-- Sub-group Section -->
<section class="sub-group-section">
    <div class="container-fluid">
        <div class="sub-group">
            <div class="row">
                <div class="col-md-3">
                    <div class="left-sidebar">
                        <div class="left-sidebar-header d-flex justify-content-between">
                            <a href="{{ route('home') }}" class="dashboard">
                                <h5 class="d-flex align-items-center">
                                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.1652 6.91833L4.0835 14L11.1652 21.0817" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M23.9167 14H4.28174" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span class="mx-2">Dashboard</span>
                                </h5>
                            </a>
                            <a href="#!" class="btn-right-menu">
                                <i class="fa-solid fa-plus"></i>
                            </a>
                        </div>
                        <div class="left-sidebar-body">
                            <span class="msg-lable">Messages</span>
                            <div class="chatlist-cover">
                                <ul>

                                    @if (isset($students))
                                    @foreach ($students as $student)
                                    @if (isset($student->student))
                                    @php
                                    if(isset($student->student->profile) && $student->student->profile!=""){
                                    $profile = fullImgUrl($student->student->profile);
                                    } else {
                                    $profile = asset('web/images/placeorder.png');
                                    }
                                    @endphp
                                    <li class="user" id="{{ $student->student->id }}">
                                        <h1 id="pending{{ $student->student->id }}"></h1>
                                        <!-- {{ route('chat.show',['chat' => $student->student->id]) }} -->
                                        <a href="{{ route('chat.show',['chat' => $student->student->id]) }}" class="d-flex align-items-center">
                                            <div class="user-thumb">
                                                <!-- <a href="javascript:void(0)" class="d-flex align-items-center"> -->
                                                <img src="{{ $profile }}" alt="">
                                                @if(Cache::has('user-is-online-' . $student->student->id))
                                                <span class="position-absolute  translate-middle p-2 bg-success border border-light rounded-circle">
                                                    <span class="visually-hidden">New alerts</span>
                                                </span>
                                                @else
                                                <span class="position-absolute  translate-middle p-2 bg-danger border border-light rounded-circle">
                                                    <span class="visually-hidden">New alerts</span>
                                                </span>
                                                @endif
                                            </div>
                                            <p class="mx-3">{{ $student->student->first_name.' '.$student->student->last_name }}

                                                @if ($student->student->pending_chat_count != 0)
                                                <span class="badge rounded-pill bg-primary pending-chat-count-static">
                                                    {{ $student->student->pending_chat_count }}
                                                </span>
                                                @endif

                                                <span class="badge rounded-pill bg-primary pending-chat-count  pending-chat-count-{{ $student->student->id }}">
                                                </span>

                                                <!-- <span class="badge rounded-pill bg-danger messagePending" id="messagePending{{ $student->student->id}}"> </span> -->
                                            </p>

                                        </a>


                                        </span>
                                    </li>
                                    @endif
                                    @endforeach
                                    @endif



                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" id="">



                    <div class="users-section-cover position-relative mt-3">
                        <div class="chat-view-header">
                            <span class="d-flex align-items-center">
                                @php
                                if(isset($studentDetails->profile) && $studentDetails->profile!=""){
                                $profile = fullImgUrl($studentDetails->profile);
                                } else {
                                $profile = asset('web/images/placeorder.png');
                                }
                                @endphp

                                <img src="{{ $profile }}" alt="">


                                <p class="mx-2">{{ $studentDetails->first_name.' '.$studentDetails->last_name }}</p>
                            </span>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col msg-window-container">
                                    <div class="card chat-talk" id="msgWindow">
                                        <div class="card-body message-wrapper" id="msgs">


                                        </div>

                                        <div class="card-footer">
                                            <div class="input-group" id="" data-sender="me">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                <input class="form-control" name="message" type="text" placeholder="Type a Message..." id="chat-text-send" oninput="validate(this)">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="button" id="chat-text-send">
                                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M15.0703 5.51001L6.51026 1.23001C0.760264 -1.64999 -1.59974 0.710012 1.28026 6.46001L2.15026 8.20001C2.40026 8.71001 2.40026 9.30001 2.15026 9.81001L1.28026 11.54C-1.59974 17.29 0.750264 19.65 6.51026 16.77L15.0703 12.49C18.9103 10.57 18.9103 7.43001 15.0703 5.51001ZM11.8403 9.75001H6.44026C6.03026 9.75001 5.69026 9.41001 5.69026 9.00001C5.69026 8.59001 6.03026 8.25001 6.44026 8.25001H11.8403C12.2503 8.25001 12.5903 8.59001 12.5903 9.00001C12.5903 9.41001 12.2503 9.75001 11.8403 9.75001Z" fill="#1DA1F2"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                </div>


                <div class="col-md-3">




                    <div class="right-sidebar">
                        <div class="right-sidebar-header d-flex justify-content-between">
                            <a href="#!" class="all-user-list">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.57 5.93005L3.5 12.0001L9.57 18.0701" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M20.4999 12H3.66992" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                            <h5 class="d-flex align-items-center">
                                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g opacity="0.6">
                                        <path d="M14.186 12.6817C14.0693 12.67 13.9293 12.67 13.801 12.6817C11.0243 12.5884 8.81934 10.3134 8.81934 7.51337C8.81934 4.65504 11.1293 2.33337 13.9993 2.33337C16.8577 2.33337 19.1793 4.65504 19.1793 7.51337C19.1677 10.3134 16.9627 12.5884 14.186 12.6817Z" stroke="black" stroke-width="2.1" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M8.35285 16.9866C5.52952 18.8766 5.52952 21.9566 8.35285 23.835C11.5612 25.9816 16.8229 25.9816 20.0312 23.835C22.8545 21.945 22.8545 18.865 20.0312 16.9866C16.8345 14.8516 11.5729 14.8516 8.35285 16.9866Z" stroke="black" stroke-width="2.1" stroke-linecap="round" stroke-linejoin="round" />
                                    </g>
                                </svg>
                                <span>Student Information</span>
                            </h5>
                            <a href="#!" class="btn-left-menu">
                                <i class="fa-solid fa-plus"></i>
                            </a>
                        </div>
                        <div class="right-sidebar-body">
                            <div class="selected-user-profile text-center d-block">
                                @php
                                if(isset($studentDetails->profile) && $studentDetails->profile!=""){
                                $profile = fullImgUrl($studentDetails->profile);
                                } else {
                                $profile = asset('web/images/placeorder.png');
                                }
                                @endphp
                                <img src="{{ $profile }}" alt="">
                                <h3>{{ $studentDetails->first_name.' '.$studentDetails->last_name }}</h3>
                                <p>{{ $studentDetails->email }}</p>
                                <span>{{ $studentDetails->country_code }} {{ $studentDetails->contact }}</span>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</section>
<!---------------------------->

@endsection


@section('js')
<script>
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
</script>

<script>
    $('.messagePending').hide();
    var receiver_id = '';
    var my_id = "{{ Auth::id() }}";
    var pusherId = "{{ env('PUSHER_APP_KEY') }}";
    var pusherCluster = "{{ env('PUSHER_APP_CLUSTER') }}";
    $(document).ready(function() {
        // ajax setup form carf token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Enable pusher logging - don't include this in production
        // Pusher.logToConsole = true;

        var pusher = new Pusher(pusherId, {
            cluster: pusherCluster,
            forceTLS: true
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('chat-event', function(data) {
            // alert(JSON.stringify(data));
            $.ajax({
                type: "get",
                url: SITE_URL + "/chat/user/message/" + receiver_id,
                data: "",
                cache: false,
                success: function(data) {
                    $('#msgs').html(data);
                    scrollToBottomFunc();
                }
            });
            if (my_id == data.from) {
                $('#' + data.to).click();
            } else if (my_id == data.to) {
                if (receiver_id == data.from) {
                    // if receiver is selected, reload the selected user
                    $('#' + data.from).click();
                } else {
                    var pending = parseInt($('#' + data.from).find('.pending').html());
                    // alert(pending);
                    if (pending) {
                        // $('#' + data.from).find('.pending').html(pending + 1);
                        // $('#pending' + data.from).val(pending + 1);
                        // alert(pending + 1);
                        // $('.messagePending').show();
                        // $('#messagePending' + data.from).text(pending + 1);
                    } else {
                        // $('#' + data.from).append('<span class="pending">1</span>');
                        // $('#pending' + data.from).val('1');
                        // $('.messagePending').show();
                        // $('#messagePending' + data.from).text(1);
                    }
                }
            }
        });

        $('.user').removeClass('active');
        $(this).addClass('active');
        $(this).find('.pending').remove();
        receiver_id = '{{ Request::segment(2);  }}'; //$(this).attr('id');
        $.ajax({
            type: "get",
            url: SITE_URL + "/chat/user/message/" + receiver_id,
            data: "",
            cache: false,
            success: function(data) {
                $('#msgs').html(data);
                scrollToBottomFunc();
            }
        });


        $(document).keypress(function(event) {



            var keycode = (event.keyCode ? event.keyCode : event.which);

            // if (keycode == '32') {
            //     return false
            // }

            if (keycode == '13') {
                var message = $("input[name=message]").val();
                var token = $("input[name=_token]").val();
                if (message != '' && receiver_id != '') {
                    $("#msgs").append('<div class="msg from">' + message + '</div>');
                    scrollToBottomFunc();
                    $("input[name=message]").val('');
                    var datastr = "receiver_id=" + receiver_id + "&message=" + message + "&_token=" + token;
                    $.ajax({
                        type: "post",
                        url: SITE_URL + "/chat",
                        data: datastr,
                        cache: false,
                        beforeSend: function() {
                            // $("#pageLoader").addClass("pageLoader");
                        },
                        success: function(data) {

                        },
                        error: function(jqXHR, status, err) {
                            console.log(err);
                        },
                        complete: function() {
                            scrollToBottomFunc();
                            // $("#pageLoader").removeClass("pageLoader");
                        }
                    });
                }
            }
        });

        $(document).on('click', '#chat-text-send', function(e) {
            var message = $("input[name=message]").val();
            var token = $("input[name=_token]").val();
            if (message != '' && receiver_id != '') {
                $("#msgs").append('<div class="msg from">' + message + '</div>');
                $("input[name=message]").val('');
                scrollToBottomFunc();
                var datastr = "receiver_id=" + receiver_id + "&message=" + message + "&_token=" + token;
                $.ajax({
                    type: "post",
                    url: SITE_URL + "/chat",
                    data: datastr,
                    cache: false,
                    beforeSend: function() {
                        // $("#pageLoader").addClass("pageLoader");
                    },
                    success: function(data) {

                    },
                    error: function(jqXHR, status, err) {
                        console.log(err);
                    },
                    complete: function() {
                        scrollToBottomFunc();
                        //$("#pageLoader").removeClass("pageLoader");
                    }
                });
            }
        })
    });

    // make a function to scroll down auto
    function scrollToBottomFunc() {
        $('.message-wrapper').animate({
            scrollTop: $('.message-wrapper').get(0).scrollHeight
        }, 50);
    }
</script>
@endsection
