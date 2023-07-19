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


                                    <li>
                                        <a href="{{ route('chat.show',['chat' => $student->student->id]) }}" class="d-flex align-items-center direct-chat">
                                            <div class="user-thumb">
                                                <img src="{{ $profile }}" alt="">
                                                <!-- @if(Cache::has('user-is-online-' . $student->student->id))
                                                <span class="position-absolute  translate-middle p-2 bg-success border border-light rounded-circle">
                                                </span>
                                                @else
                                                <span class="position-absolute  translate-middle p-2 bg-danger border border-light rounded-circle">
                                                </span>
                                                @endif -->



                                                @if(Cache::has('user-is-online-' . $student->student->id))
                                                <span class="position-absolute  translate-middle p-2 bg-success border user-status-static border-light rounded-circle user-online-{{ $student->student->id }}">
                                                    <span class="visually-hidden">New alerts</span>
                                                </span>
                                                @else
                                                <span class="position-absolute  translate-middle p-2 bg-danger border user-status-static border-light rounded-circle user-ofline-{{ $student->student->id }}">
                                                    <span class="visually-hidden">New alerts</span>
                                                </span>
                                                @endif

                                                <span class="position-absolute  translate-middle p-2 border user-status border-light rounded-circle user-status-{{ $student->student->id }}">
                                                    <span class="visually-hidden">New alerts</span>
                                                </span>


                                            </div>
                                            <p class="mx-3">{{ $student->student->first_name.' '.$student->student->last_name }}</p>

                                            @if ($student->student->pending_chat_count != 0)
                                            <span class="badge rounded-pill bg-primary pending-chat-count-static">
                                                {{ $student->student->pending_chat_count }}
                                            </span>
                                            @endif

                                            <span class="badge rounded-pill bg-primary pending-chat-count  pending-chat-count-{{ $student->student->id }}">
                                            </span>
                                        </a>
                                    </li>


                                    @endif
                                    @endforeach
                                    @endif



                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="users-section-cover position-relative">
                        <div class="blankmessage d-flex justify-content-center">
                            <img src="{{ asset('web/images/blank-msg.png') }}" alt="">
                            <h5>Get Started</h5>
                            <p class="mx-3">Select an individual from the left menu to start a conversation</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">

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
@endsection
