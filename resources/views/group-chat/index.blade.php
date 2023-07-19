@extends('layouts.app')


@section('content')


<!-- Sub-group Section -->

<section class="sub-group-section">
    <div class="container-fluid">
        <div class="sub-group change-theme">
            <div class="row">



                <div class="col-md-3">
                    <div class="left-sidebar">
                        <div class="left-sidebar-header d-flex justify-content-between">
                            <a href="{{ route('home') }}">
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
                            <div class="zoom-meeting-link">
                                <label for="" class="d-block my-2">Zoom</label>
                                <a href="#!" class="zoom-link">
                                    <img src="{{ asset('web/images/Zoom_logo.png') }}" alt="">
                                    Create New Meeting
                                </a>
                            </div>

                            <div class="my-3">
                                <label for="">Meeting(s)</label>

                                @if ($ongoingMeeting)
                                @foreach ($ongoingMeeting as $meeting)

                                @php
                                $joinMeetings = App\Models\JoinMeeting::with('user')->whereGroupChatId($meeting->id)->get();
                                @endphp



                                <div class="meeting-groups" id="meeting">
                                    <span class="d-flex justify-content-between align-items-center">
                                        <p>{{ $meeting->message }}</p>

                                        @php
                                        if (auth()->user()->id == $meeting->sender_id){
                                        $meetingUrl = $meeting->start_url;
                                        } else {
                                        $meetingUrl = $meeting->join_url;
                                        }
                                        @endphp


                                        <a href="javascript:void(0)" class="join-link" onclick="joinMeeting('{{ auth()->user()->id }}','{{ $meeting->id }}','{{ $meeting->join_url }}')">Join</a>
                                    </span>
                                    <div class="avatar-container">

                                        @if ($joinMeetings)
                                        @foreach ($joinMeetings as $joinMeeting)

                                        @php
                                        if(isset($joinMeeting->user->profile) && $joinMeeting->user->profile!=""){
                                        $profile = fullImgUrl($joinMeeting->user->profile);
                                        } else {
                                        $profile = asset('web/images/placeorder.png');
                                        }
                                        @endphp


                                        <div class="avatar-container-item"><img src="{{ $profile }}" alt="">
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                                @endif


                            </div>
                        </div>
                    </div>
                </div>





                <div class="col-md-6" id="">
                    <div class="users-section-cover">
                        <div class="chat-view-header d-flex align-items-center justify-content-between">
                            <div class="d-flex justify-content-between align-items-center">
                                <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M37.2557 20.8445L29.5557 17.3V7.14446C29.5522 6.9314 29.4875 6.72384 29.3693 6.54654C29.2511 6.36924 29.0844 6.22967 28.8891 6.14446L20.5557 2.31112C20.4095 2.24343 20.2502 2.20837 20.0891 2.20837C19.9279 2.20837 19.7686 2.24343 19.6224 2.31112L11.2891 6.14446C11.0962 6.23372 10.933 6.37641 10.8187 6.55563C10.7045 6.73484 10.6441 6.94305 10.6446 7.15557V17.3111L2.97794 20.8445C2.78508 20.9337 2.62185 21.0764 2.50763 21.2556C2.39341 21.4348 2.33297 21.6431 2.3335 21.8556V32.7222C2.33297 32.9348 2.39341 33.143 2.50763 33.3222C2.62185 33.5014 2.78508 33.6441 2.97794 33.7333L11.3113 37.5667C11.4575 37.6344 11.6168 37.6694 11.7779 37.6694C11.9391 37.6694 12.0983 37.6344 12.2446 37.5667L20.1113 33.9445L27.9779 37.5667C28.1242 37.6344 28.2834 37.6694 28.4446 37.6694C28.6058 37.6694 28.765 37.6344 28.9113 37.5667L37.2446 33.7333C37.4375 33.6441 37.6007 33.5014 37.7149 33.3222C37.8291 33.143 37.8896 32.9348 37.889 32.7222V21.8556C37.8906 21.6443 37.8318 21.4369 37.7196 21.2578C37.6074 21.0787 37.4465 20.9353 37.2557 20.8445ZM34.1335 21.8556L28.4557 24.4445L22.7779 21.8556L28.4557 19.2445L34.1335 21.8556ZM20.1113 4.53335L25.7891 7.14446L20.1113 9.75557L14.4446 7.14446L20.1113 4.53335ZM11.7779 19.2333L17.4557 21.8445L11.7779 24.4445L6.10017 21.8556L11.7779 19.2333ZM19.0002 32L11.7779 35.3333L4.55572 32V23.5889L11.3113 26.6667C11.4545 26.7311 11.6098 26.7644 11.7668 26.7644C11.9239 26.7644 12.0791 26.7311 12.2224 26.6667L18.9779 23.5556L19.0002 32ZM12.8891 17.3V8.8889L19.6446 12C19.7909 12.0677 19.9501 12.1028 20.1113 12.1028C20.2724 12.1028 20.4317 12.0677 20.5779 12L27.3335 8.8889V17.3111L20.1113 20.6445L12.8891 17.3ZM35.6779 32.0111L28.4557 35.3445L21.2224 32.0111V23.5778L27.9891 26.6667C28.1308 26.7295 28.2841 26.7619 28.4391 26.7619C28.594 26.7619 28.7473 26.7295 28.8891 26.6667L35.6446 23.5556L35.6779 32.0111Z" fill="#1DA1F2" />
                                </svg>
                                <div class="mx-3">
                                    <p class="">{{ $subGroup->name }}</p>
                                    <span class="d-flex align-items-center">
                                        <!-- You and 15 other students -->
                                        {{ count($subGroupMembers) }} students
                                    </span>
                                </div>
                            </div>
                            <a href="#!" class="leave-meeting">
                                Leave
                            </a>
                        </div>
                        <div class="row">
                            <div class="col msg-window-container">
                                <div class="card chat-talk" id="msgWindow">

                                    <div class="card-body message-wrapper group-msg" id="msgs">






                                    </div>

                                    <div class="card-footer">
                                        <div class="input-group" id="msgForm" data-sender="me">

                                            <div class="input-group-append share-icon d-flex align-items-center">
                                                <a href="#!">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M17.1985 21.0929C15.8567 21.093 14.466 20.4377 13.1621 19.1349L3.09684 9.04391C2.69384 8.64123 2.20678 7.89916 2.05146 7.0262C1.91787 6.27453 1.97971 5.15739 3.03483 4.10227C4.11617 3.01982 5.19302 2.92459 5.90632 3.03565C6.93493 3.19528 7.67523 3.8423 7.94563 4.11249L18.0559 14.2469C18.3328 14.5233 18.9835 15.1729 18.9835 16.053C18.9835 16.5893 18.7467 17.0976 18.2793 17.5639C17.8624 17.9818 16.7167 18.7831 15.1139 17.1831L5.02084 7.0978C4.79681 6.87425 4.79681 6.51152 5.02036 6.28796C5.24423 6.06377 5.60697 6.06409 5.8302 6.28748L15.9233 16.3724C16.8892 17.3359 17.3112 16.9125 17.4698 16.7536C17.7147 16.5095 17.8384 16.2738 17.8384 16.0526C17.8384 15.6475 17.4384 15.2484 17.2462 15.0566L7.13595 4.92221C6.94531 4.73158 6.426 4.27567 5.73103 4.16768C5.07602 4.06589 4.44069 4.31629 3.84545 4.91215C3.27851 5.47908 3.05463 6.12292 3.17976 6.82584C3.28858 7.43801 3.63981 7.96707 3.90763 8.23444L13.9729 18.3259C15.1272 19.4791 17.408 21.0719 19.7048 18.7758C20.7577 17.723 21.0858 16.6223 20.708 15.4109C20.472 14.6533 19.9499 13.8561 19.1986 13.1054L10.4154 4.36309C10.1912 4.14002 10.1904 3.7773 10.4136 3.55325C10.6367 3.32922 10.9991 3.3281 11.2235 3.55149L20.0067 12.2942C20.8895 13.1766 21.5097 14.136 21.8007 15.0697C22.1508 16.1924 22.2118 17.8877 20.5138 19.5859C19.5067 20.5929 18.3711 21.0935 17.1986 21.0935L17.1985 21.0929Z" fill="#1DA1F2" />
                                                    </svg>
                                                </a>
                                                <ul class="share-file-info">
                                                    <li>
                                                        <a href="#!" onclick="uploadMedia(2)">Audio</a>
                                                    </li>
                                                    <li>
                                                        <a href="#!" onclick="uploadMedia(3)">Video</a>
                                                    </li>
                                                    <li>
                                                        <a href="#!" onclick="uploadMedia(5)">Document</a>
                                                    </li>
                                                    <li>
                                                        <a href="#!" onclick="uploadMedia(6)">Image</a>
                                                    </li>
                                                </ul>
                                            </div>

                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                            <input class="form-control" name="message" type="text" placeholder="Type a Message..." oninput="validate(this)" />



                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="button" id="chat-text-send">
                                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M15.0703 5.51001L6.51026 1.23001C0.760264 -1.64999 -1.59974 0.710012 1.28026 6.46001L2.15026 8.20001C2.40026 8.71001 2.40026 9.30001 2.15026 9.81001L1.28026 11.54C-1.59974 17.29 0.750264 19.65 6.51026 16.77L15.0703 12.49C18.9103 10.57 18.9103 7.43001 15.0703 5.51001ZM11.8403 9.75001H6.44026C6.03026 9.75001 5.69026 9.41001 5.69026 9.00001C5.69026 8.59001 6.03026 8.25001 6.44026 8.25001H11.8403C12.2503 8.25001 12.5903 8.59001 12.5903 9.00001C12.5903 9.41001 12.2503 9.75001 11.8403 9.75001Z" fill="#1DA1F2" />
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
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g opacity="0.6">
                                        <path d="M7.63314 9.05829C7.5498 9.04996 7.4498 9.04996 7.35814 9.05829C5.3748 8.99163 3.7998 7.36663 3.7998 5.36663C3.7998 3.32496 5.4498 1.66663 7.4998 1.66663C9.54147 1.66663 11.1998 3.32496 11.1998 5.36663C11.1915 7.36663 9.61647 8.99163 7.63314 9.05829Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M13.6752 3.33337C15.2919 3.33337 16.5919 4.64171 16.5919 6.25004C16.5919 7.82504 15.3419 9.10837 13.7836 9.16671C13.7169 9.15837 13.6419 9.15837 13.5669 9.16671" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M3.4666 12.1334C1.44993 13.4834 1.44993 15.6834 3.4666 17.025C5.75827 18.5584 9.5166 18.5584 11.8083 17.025C13.8249 15.675 13.8249 13.475 11.8083 12.1334C9.52494 10.6084 5.7666 10.6084 3.4666 12.1334Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M15.2832 16.6666C15.8832 16.5416 16.4499 16.3 16.9165 15.9416C18.2165 14.9666 18.2165 13.3583 16.9165 12.3833C16.4582 12.0333 15.8999 11.8 15.3082 11.6666" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </g>
                                </svg>
                                <span id="student-title">Students</span>
                            </h5>
                            <a href="#!" class="btn-left-menu">
                                <i class="fa-solid fa-plus"></i>
                            </a>
                        </div>
                        <div class="right-sidebar-body">
                            <div class="selected-user-profile text-center">
                                <img id="profile" src="" alt="">
                                <h3 id="username"></h3>
                                <p id="email"></p>
                                <span id="contact"></span>
                                <a id="chatUrl" href="#!" class="d-flex align-items-center">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.08317 15.8333H6.6665C3.33317 15.8333 1.6665 15 1.6665 10.8333V6.66663C1.6665 3.33329 3.33317 1.66663 6.6665 1.66663H13.3332C16.6665 1.66663 18.3332 3.33329 18.3332 6.66663V10.8333C18.3332 14.1666 16.6665 15.8333 13.3332 15.8333H12.9165C12.6582 15.8333 12.4082 15.9583 12.2498 16.1666L10.9998 17.8333C10.4498 18.5666 9.54984 18.5666 8.99984 17.8333L7.74984 16.1666C7.6165 15.9833 7.30817 15.8333 7.08317 15.8333Z" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M5.8335 6.66663H14.1668" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M5.8335 10.8334H10.8335" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    Message
                                </a>
                            </div>
                            <ul class="all-users">


                                @if ($subGroupMembers)
                                @foreach ($subGroupMembers as $subGroupMember)
                                @php
                                if(isset($subGroupMember->user->profile) && $subGroupMember->user->profile!=""){
                                $profile = fullImgUrl($subGroupMember->user->profile);
                                } else {
                                $profile = asset('web/images/placeorder.png');
                                }
                                @endphp
                                <li>
                                    <a href="javascript:void(0)" class="project-management" onclick="showProfile('{{ $subGroupMember->user->id }}','{{ $profile }}','{{ $subGroupMember->user->first_name.' '.$subGroupMember->user->last_name }}','{{ $subGroupMember->user->email }}','{{ $subGroupMember->user->country_code.' '.$subGroupMember->user->contact }}')">
                                        <div class="user-thumb">
                                            <img src="{{ $profile }}" alt="">


                                            <!-- @if(Cache::has('user-is-online-' . $subGroupMember->user->id))
                                            <span class="position-absolute  translate-middle p-2 bg-success border border-light rounded-circle">
                                                <span class="visually-hidden">New alerts</span>
                                            </span>
                                            @else
                                            <span class="position-absolute  translate-middle p-2 bg-danger border border-light rounded-circle">
                                                <span class="visually-hidden">New alerts</span>
                                            </span>
                                            @endif -->


                                            @if(Cache::has('user-is-online-' . $subGroupMember->user->id))
                                            <span class="position-absolute  translate-middle p-2 bg-success border user-status-static border-light rounded-circle user-online-{{ $subGroupMember->user->id }}">
                                            </span>
                                            @else
                                            <span class="position-absolute  translate-middle p-2 bg-danger border user-status-static border-light rounded-circle user-ofline-{{ $subGroupMember->user->id }}">
                                            </span>
                                            @endif

                                            <span class="position-absolute  translate-middle p-2 border user-status border-light rounded-circle user-status-{{ $subGroupMember->user->id }}">
                                            </span>




                                            {{ $subGroupMember->user->first_name.' '.$subGroupMember->user->last_name }}
                                        </div>

                                    </a>
                                    <a href="{{ route('chat.show',['chat' => $subGroupMember->user->id]) }}" class="message-chat">

                                        @if ($subGroupMember->user->pending_chat_count != 0)
                                        <span class="badge rounded-pill bg-primary pending-chat-count-static">
                                            {{ $subGroupMember->user->pending_chat_count }}
                                        </span>
                                        @endif

                                        <span class="badge rounded-pill bg-primary pending-chat-count pending-chat-count-{{ $subGroupMember->user->id }}">
                                        </span>


                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7.08317 15.8333H6.6665C3.33317 15.8333 1.6665 15 1.6665 10.8333V6.66663C1.6665 3.33329 3.33317 1.66663 6.6665 1.66663H13.3332C16.6665 1.66663 18.3332 3.33329 18.3332 6.66663V10.8333C18.3332 14.1666 16.6665 15.8333 13.3332 15.8333H12.9165C12.6582 15.8333 12.4082 15.9583 12.2498 16.1666L10.9998 17.8333C10.4498 18.5666 9.54984 18.5666 8.99984 17.8333L7.74984 16.1666C7.6165 15.9833 7.30817 15.8333 7.08317 15.8333Z" stroke="#1DA1F2" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M5.8335 6.66663H14.1668" stroke="#1DA1F2" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M5.8335 10.8334H10.8335" stroke="#1DA1F2" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </a>
                                </li>
                                @endforeach
                                @endif



                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!---------------------------->

<!-- zoom-meeting popup section start-->

<div class="zoom-meeting-bg zoom-popup">
    <div class="zoom-meeting-body">
        <div class="zoom-meeting-info">
            <h3 class="text-center">Zoom Meeting</h3>
            <form>
                <div class="row">
                    <div class="col-12">
                        <div class="single-form">


                            <label for="exampleFormControlInput1" class="form-label mt-3">Add title</label>
                            <input type="text" name="topic" class="form-control" id="topic" placeholder="e.g. Homework #1" oninput="validate(this)">
                            <span class="invalid-feedback" role="alert">
                                <strong id="topic-error-msg"></strong>
                            </span>

                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="group_id" value="{{ Request::segment(3);  }}">
                        </div>
                    </div>
                </div>
            </form>
            <div class="zoom-meeting-btn">
                <a href="#!" class="btn modal-close cancel-meeting">Cancel</a>
                <a href="#!" class="btn create-meeting" id="zoom-meeting">Create</a>
            </div>
        </div>
    </div>
</div>

<!-- zoom-meeting popup section End -->

<!-- zoom-meeting-leave popup section start-->


<div class="log-out-bg leave-group">
    <div class="log-out-body">
        <div class="log-out-info">
            <h3 class="text-center">Are you sure you want to leave group?</h3>
            <div class="log-out-btn">
                <a href="#!" class="btn modal-close continue-meeting ">Cancel</a>
                <a href="javascript:void(0)" class="btn btn-danger" onclick="leaveGroup('{{ request()->segment(3) }}')" )">Leave</a>
            </div>
        </div>
    </div>
</div>

<!-- zoom-meeting-leave popup section End-->

@endsection


@section('js')

<script>
    function openEmojies(id) {
        // alert('cleck');
        $(".emoji-picker").hide();
        $(".emoji-picker-" + id).fadeIn();
    }

    function setEmoji(id, school_sub_group_id, message) {
        // alert(id);
        // alert(message);
        var group_id = id;
        var school_sub_group_id = school_sub_group_id;
        var emoji = message;
        var token = $("input[name=_token]").val();
        var datastr = "message_id=" + id + "&group_id=" + group_id + "&_token=" + token + "&emoji=" + emoji + "&school_sub_group_id=" + school_sub_group_id;
        $.ajax({
            type: "post",
            url: SITE_URL + "/group/chat/user/reaction",
            data: datastr,
            cache: false,
            beforeSend: function() {
                $("#pageLoader").addClass("pageLoader");

            },
            success: function(data) {
                // alert(data);
                $(".emoji-picker").hide();
                $('#appendEmoji' + id).html(data);

                // $('#appendEmoji'+id).append('<li><a href="#!" class=" badge"><span>sadas</span></a></li>');

            },
            error: function(jqXHR, status, err) {

            },
            complete: function() {
                $("#pageLoader").removeClass("pageLoader");
            }
        });

    }



    function removeEmoji(id, school_sub_group_id, message) {

        var group_id = id;
        var school_sub_group_id = school_sub_group_id;
        var emoji = message;
        var token = $("input[name=_token]").val();
        var datastr = "message_id=" + id + "&group_id=" + group_id + "&_token=" + token + "&emoji=" + emoji + "&school_sub_group_id=" + school_sub_group_id;
        $.ajax({
            type: "post",
            url: SITE_URL + "/group/chat/user/reaction/remove",
            data: datastr,
            cache: false,
            beforeSend: function() {
                $("#pageLoader").addClass("pageLoader");

            },
            success: function(data) {
                // alert(data);
                $(".emoji-picker").hide();
                $('#appendEmoji' + id).html(data);

                // $('#appendEmoji'+id).append('<li><a href="#!" class=" badge"><span>sadas</span></a></li>');

            },
            error: function(jqXHR, status, err) {

            },
            complete: function() {
                $("#pageLoader").removeClass("pageLoader");
            }
        });

    }
</script>

<script>
    function uploadMedia(type) {
        var groupChatId = '{{ Request::segment(3) }}';
        let input = document.createElement("input");
        input.type = "file";

        if (type == 2) {
            input.accept = "audio/*";
        } else if (type == 3) {
            input.accept = "video/*";
        } else if (type == 5) {
            input.accept = ".xlsx,.xls,.doc, .docx,.ppt, .pptx,.txt,.pdf";
        } else if (type == 6) {
            input.accept = "image/*";
        }



        input.onchange = (_) => {
            let files = Array.from(input.files);
            var postData = new FormData();
            postData.append("media", input.files[0]);
            postData.append("school_sub_group_id", groupChatId);
            postData.append("type", type);
            $.ajax({
                type: "POST",
                url: "{{ route('group-chat-upload-media') }}",
                data: postData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $("#pageLoader").addClass("pageLoader");
                },
                success: (data) => {
                    if ($.isEmptyObject(data.error)) {
                        $(".share-file-info").hide();
                        scrollToBottomFunc();
                    } else {
                        // alert(data.error);
                        if (data.error.media != undefined && data.error.media[0]) {
                            toastr.error(data.error.media[0]);
                        }
                    }
                },
                complete: function() {
                    $("#pageLoader").removeClass("pageLoader");
                    scrollToBottomFunc();
                },
                error: function(data) {
                    console.log(data);
                },
            });


        };
        input.click();

    }
</script>

<script>
    function downloadMedia(url, type, extension, original_name) {
        var filename = original_name + '.' + extension;
        $.ajax({
            url: url,
            method: 'GET',
            xhrFields: {
                responseType: 'blob'
            },
            success: function(data) {
                var a = document.createElement('a');
                var url = window.URL.createObjectURL(data);
                a.href = url;
                a.download = filename;
                document.body.append(a);
                a.click();
                a.remove();
                window.URL.revokeObjectURL(url);
            }
        });
    }
</script>

<script>
    function joinMeeting(userId, groupId, link) {
        var group_id = groupId;
        var meetingUrl = link;
        var token = $("input[name=_token]").val();
        var datastr = "group_id=" + group_id + "&_token=" + token;
        $.ajax({
            type: "post",
            url: SITE_URL + "/join/zoom/meeting",
            data: datastr,
            cache: false,
            beforeSend: function() {
                $("#pageLoader").addClass("pageLoader");
            },
            success: function(data) {
                window.open(link, '_blank');
            },
            error: function(jqXHR, status, err) {

            },
            complete: function() {
                $("#pageLoader").removeClass("pageLoader");
            }
        });
    }
</script>


<script>
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });


    function showProfile(userid, profile, username, email, contact) {
        // alert();
        $('.all-users').hide();
        $('.selected-user-profile').show();
        $('.all-user-list').show();

        $('#profile').attr('src', profile);
        $('#username').text(username);
        $('#email').text(email);
        $('#contact').text(contact);
        $('#chatUrl').attr('href', '{{ url("chat") }}/' + userid);
        $('#student-title').text('Student Information');
    }

    $('.all-user-list').click(function() {
        $('#student-title').text('Students');
        $('.all-user-list').hide();
    })

    function leaveGroup(id) {
        $.ajax({
            url: SITE_URL + '/school-sub-group-member/' + id,
            method: "DELETE",
            success: function(data) {
                location.reload(SITE_URL);
            }
        })
    }
</script>


<script>
    var group_id = '{{ Request::segment(3);  }}';
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
        //Pusher.logToConsole = true;

        var pusher = new Pusher(pusherId, {
            cluster: pusherCluster,
            forceTLS: true
        });

        var channel = pusher.subscribe('my-channel');

        channel.bind('my-event', function(data) {



            $.ajax({
                type: "get",
                url: SITE_URL + "/group/chat/message/" + group_id,
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

                    if (pending) {} else {}
                }
            }
        });


        $('.user').removeClass('active');
        $(this).addClass('active');
        $(this).find('.pending').remove();

        $.ajax({
            type: "get",
            url: SITE_URL + "/group/chat/message/" + group_id,
            data: "",
            cache: false,
            success: function(data) {
                $('#msgs').html(data);
                scrollToBottomFunc();
            }
        });



        $(document).keypress(function(event) {

            var keycode = (event.keyCode ? event.keyCode : event.which);

            if (keycode == '13') {
                var message = $("input[name=message]").val();
                var token = $("input[name=_token]").val();
                if (message != '' && group_id != '') {
                    $("#msgs").append('<div class="msg from">' + message + '</div>');
                    scrollToBottomFunc();
                    $("input[name=message]").val('');
                    var datastr = "group_id=" + group_id + "&message=" + message + "&_token=" + token;
                    $.ajax({
                        type: "post",
                        url: SITE_URL + "/group/chat",
                        data: datastr,
                        cache: false,
                        beforeSend: function() {

                        },
                        success: function(data) {

                        },
                        error: function(jqXHR, status, err) {
                            console.log(err);
                        },
                        complete: function() {
                            scrollToBottomFunc();
                        }
                    });
                }
            }
        });


        $(document).on('click', '#chat-text-send', function(e) {
            var message = $("input[name=message]").val();
            var token = $("input[name=_token]").val();
            if (message != '' && group_id != '') {
                $("#msgs").append('<div class="msg from">' + message + '</div>');
                scrollToBottomFunc();
                $("input[name=message]").val('');
                var datastr = "group_id=" + group_id + "&message=" + message + "&_token=" + token;
                $.ajax({
                    type: "post",
                    url: SITE_URL + "/group/chat",
                    data: datastr,
                    cache: false,
                    beforeSend: function() {

                    },
                    success: function(data) {

                    },
                    error: function(jqXHR, status, err) {
                        console.log(err);
                    },
                    complete: function() {
                        scrollToBottomFunc();
                    }
                });
            }
        })



        $(document).on('click', '#zoom-meeting', function(e) {
            var topic = $("input[name=topic]").val();
            // var email = $("#verifyEmail").val();

            // if (topic == '') {
            //     $("#verifyEmail").addClass("is-invalid");
            //     $("#email-error-msg").text('Please enter host!');
            //     return false
            // } else {
            //     $("#verifyEmail").removeClass("is-invalid");
            //     $("#email-error-msg").text("");
            // }

            if (topic == '') {
                $("#topic").addClass("is-invalid");
                $("#topic-error-msg").text('Please enter zoom title!');
                return false
            } else {
                $("#topic").removeClass("is-invalid");
                $("#topic-error-msg").text("");
            }

            var group_id = $("input[name=group_id]").val();
            var token = $("input[name=_token]").val();
            var datastr = "group_id=" + group_id + "&topic=" + topic + "&_token=" + token;
            $.ajax({
                type: "post",
                url: SITE_URL + "/zoom/meeting",
                data: datastr,
                cache: false,
                beforeSend: function() {
                    $("#pageLoader").addClass("pageLoader");
                },
                success: function(data) {
                    $("input[name=topic]").val('');
                    $(".zoom-popup").fadeOut();
                    location.reload();
                },
                error: function(jqXHR, status, err) {

                },
                complete: function() {
                    $("#pageLoader").removeClass("pageLoader");
                }
            });
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
