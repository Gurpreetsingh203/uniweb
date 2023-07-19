@extends('layouts.app')


@section('content')
<section class="sub-group-section">
    <div class="container-fluid">
        <div class="sub-group">
            <div class="row">
                <div class="col-md-3">
                    <div class="left-sidebar">
                        <div class="left-sidebar-header d-flex justify-content-between">
                            <h5 class="d-flex align-items-center">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g opacity="0.6">
                                        <path d="M10.05 2.53004L4.03002 6.46004C2.10002 7.72004 2.10002 10.54 4.03002 11.8L10.05 15.73C11.13 16.44 12.91 16.44 13.99 15.73L19.98 11.8C21.9 10.54 21.9 7.73004 19.98 6.47004L13.99 2.54004C12.91 1.82004 11.13 1.82004 10.05 2.53004Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M5.63012 13.08L5.62012 17.77C5.62012 19.04 6.60012 20.4 7.80012 20.8L10.9901 21.86C11.5401 22.04 12.4501 22.04 13.0101 21.86L16.2001 20.8C17.4001 20.4 18.3801 19.04 18.3801 17.77V13.13" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M21.3999 15V9" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </g>
                                </svg>
                                <span class="mx-2">Your Courses</span>
                            </h5>
                            <a href="#!" class="btn-right-menu">
                                <i class="fa-solid fa-plus"></i>
                            </a>
                        </div>
                        <div class="left-sidebar-body">
                            <ul>
                                @if ($myGroups)
                                @foreach ($myGroups as $myGroup)
                                <li>
                                    <a href="{{ route('group',['group' => $myGroup->id]) }}" class="project-select myGroup @php if(request()->segment(2) == $myGroup->id){ echo 'active'; }  @endphp">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M10.74 15.53L14.26 12L10.74 8.46997" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        {{ $myGroup->name }}
                                    </a>
                                </li>
                                @endforeach
                                @endif




                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="users-section-cover position-relative">
                        <div class="user-header">
                            <h3>{{ (isset($school->user->name)) ? $school->user->name : '' }}</h3>
                        </div>
                        <div class="card mt-3">
                            <h6>Tags</h6>
                            <div class="select-status-cover">
                                <div class="status-inner d-flex align-items-center">
                                    <img src="{{ asset('web/images/time-management.png') }}" alt="">
                                    <div class="status-heading">
                                        <h5>Select Tag</h5>
                                        <span>
                                            Create new tag if not available
                                        </span>
                                    </div>
                                </div>
                                <div class="add-multiple-status">
                                    <div id="app" class="font-sans text-black bg-grey-lighter px-8 py-8 min-h-screen">
                                        <div class="max-w-sm w-full mx-auto">


                                            <div class="mb-8">
                                                <div class="tags-input d-flex align-items-center my-3 flex-wrap">

                                                    @if (isset($subGroups))
                                                    @foreach ($subGroups as $subGroup)
                                                    <span class="tags-input-tag" onclick="joinSubGroup('{{ $subGroup->id }}')">
                                                        <span>{{ $subGroup->name }}</span>
                                                    </span>
                                                    @endforeach
                                                    @endif

                                                    <a href="#!" class="tags-input-text" id="create-new-tag">
                                                        <svg class="mx-1" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M6 0C5.58584 0 5.24997 0.335861 5.24997 0.750033V5.24997H0.750034C0.335874 5.24997 0 5.58565 0 6C0 6.41416 0.335861 6.75003 0.750034 6.75003H5.24997V11.25C5.24997 11.6641 5.58583 12 6 12C6.41418 12 6.75004 11.6641 6.75004 11.25V6.75003H11.25C11.6641 6.75003 12 6.41417 12 6C12 5.58583 11.6641 5.24997 11.25 5.24997H6.75004V0.750033C6.75004 0.335874 6.41435 0 6 0V0Z" fill="white" />
                                                        </svg>
                                                        Create New Tag
                                                    </a>
                                                </div>
                                            </div>




                                            <div class="tag-bg mt-3 add-tags-cover">
                                                <div class="container">
                                                    <form method="POST" action="" id="addTag">
                                                        <div class="row">
                                                            <div class="col-md-7 col-12 my-3">
                                                                <div class="input-group tag-wrap ">
                                                                    <span class="input-group-text" id="basic-addon1">
                                                                        <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M12.4591 26C11.4542 26.0026 10.49 25.6029 9.78177 24.8902L3.10894 18.2174C2.39886 17.5073 2 16.5442 2 15.5401C2 14.5357 2.39889 13.5728 3.10894 12.8625L12.864 3.10737C13.6616 2.3112 14.7719 1.91119 15.8938 2.01662L21.972 2.6073C22.8477 2.6913 23.6666 3.07725 24.2884 3.69933C24.9103 4.32117 25.2965 5.14011 25.3805 6.0158L25.9825 12.1054C26.0879 13.2273 25.688 14.3376 24.8918 15.1351L15.1367 24.8902C14.4281 25.6029 13.464 26.0026 12.4591 25.9999L12.4591 26ZM15.5419 3.51218C14.9394 3.51271 14.3619 3.75231 13.9361 4.17867L4.18095 13.9338C3.75432 14.3601 3.51446 14.9384 3.51446 15.5415C3.51446 16.1446 3.75432 16.7228 4.18095 17.1491L10.8538 23.818C11.2799 24.2446 11.8582 24.4845 12.4613 24.4845C13.0644 24.4845 13.6429 24.2446 14.0689 23.818L23.8207 14.0629C24.3009 13.5829 24.541 12.9132 24.4758 12.2375L23.8851 6.15532C23.8341 5.63122 23.6027 5.1412 23.2303 4.76898C22.8581 4.39651 22.368 4.1651 21.8439 4.11411L15.7617 3.52344L15.5419 3.51218Z" fill="#1DA1F2" />
                                                                            <path d="M17.3028 13.8852C16.3124 13.8791 15.3813 13.4131 14.7824 12.6241C14.1838 11.8353 13.9857 10.813 14.2461 9.8575C14.5068 8.90201 15.1966 8.12194 16.1129 7.74627C17.0291 7.37036 18.068 7.44195 18.9244 7.93938C19.7806 8.4368 20.3573 9.30408 20.4846 10.2862C20.6122 11.2684 20.2759 12.254 19.5751 12.9535C18.9728 13.5558 18.1544 13.8912 17.3027 13.8852L17.3028 13.8852ZM17.3028 9.00764V9.00738C16.7444 9.0087 16.2231 9.28818 15.9133 9.75309C15.6037 10.2178 15.5461 10.8063 15.7601 11.3222C15.9738 11.8381 16.431 12.2135 16.9787 12.3229C17.5266 12.432 18.0927 12.2611 18.4881 11.8667C18.803 11.5526 18.98 11.1265 18.9802 10.6817C18.9802 10.2371 18.8035 9.8107 18.4889 9.49665C18.1743 9.18259 17.7474 9.00662 17.3028 9.00741L17.3028 9.00764Z" fill="#1DA1F2" />
                                                                        </svg>
                                                                    </span>
                                                                    <input type="hidden" name="school_group_id" id="" value="{{ request()->segment(2) }}">
                                                                    <!-- <input name="name" id="name" class="text-input w-100 flex-1 mr-2" placeholder="New tag"> -->
                                                                    <input type="text" name="name" id="name" class="form-control" placeholder="Add Tag" aria-label="Username" aria-describedby="basic-addon1" required>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-5 col-12 my-3">
                                                                <div class="d-flex align-items-center add-tag-wrap">
                                                                    <select name="timeframe" class="form-select" aria-label="Default select example" require>
                                                                        <option value="">Select Timeframe</option>
                                                                        <option value="1 week">1 week</option>
                                                                        <option value="2 weeks">2 weeks</option>
                                                                        <option value="3 weeks">3 weeks</option>
                                                                        <option value="a month">a month</option>
                                                                        <option value="indefinite">indefinite </option>
                                                                    </select>
                                                                    <button type="submit" class="btn btn-primary tags-input-text">
                                                                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg" class="mx-1">
                                                                            <path d="M6 0C5.58584 0 5.24997 0.335861 5.24997 0.750033V5.24997H0.750034C0.335874 5.24997 0 5.58565 0 6C0 6.41416 0.335861 6.75003 0.750034 6.75003H5.24997V11.25C5.24997 11.6641 5.58583 12 6 12C6.41418 12 6.75004 11.6641 6.75004 11.25V6.75003H11.25C11.6641 6.75003 12 6.41417 12 6C12 5.58583 11.6641 5.24997 11.25 5.24997H6.75004V0.750033C6.75004 0.335874 6.41435 0 6 0V0Z" fill="white"></path>
                                                                        </svg>Add
                                                                    </button>
                                                                </div>
                                                            </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>




                                        <!-- <div class="bg-light add-tags-cover">
                                            <div class="p-4">
                                                <form method="POST" action="" id="addTag">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="d-flex input-field-cover align-items-center">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M10.4591 24C9.45424 24.0026 8.49002 23.6029 7.78177 22.8902L1.10894 16.2174C0.39886 15.5073 0 14.5442 0 13.5401C0 12.5357 0.398887 11.5728 1.10894 10.8625L10.864 1.10737C11.6616 0.3112 12.7719 -0.0888098 13.8938 0.0166198L19.972 0.607296C20.8477 0.691301 21.6666 1.07725 22.2884 1.69933C22.9103 2.32117 23.2965 3.14011 23.3805 4.0158L23.9825 10.1054C24.0879 11.2273 23.688 12.3376 22.8918 13.1351L13.1367 22.8902C12.4281 23.6029 11.464 24.0026 10.4591 23.9999L10.4591 24ZM13.5419 1.51218C12.9394 1.51271 12.3619 1.75231 11.9361 2.17867L2.18095 11.9338C1.75432 12.3601 1.51446 12.9384 1.51446 13.5415C1.51446 14.1446 1.75432 14.7228 2.18095 15.1491L8.85378 21.818C9.27988 22.2446 9.85817 22.4845 10.4613 22.4845C11.0644 22.4845 11.6429 22.2446 12.0689 21.818L21.8207 12.0629C22.3009 11.5829 22.541 10.9132 22.4758 10.2375L21.8851 4.15532C21.8341 3.63122 21.6027 3.1412 21.2303 2.76898C20.8581 2.39651 20.368 2.1651 19.8439 2.11411L13.7617 1.52344L13.5419 1.51218Z" fill="#1DA1F2" />
                                                                <path d="M15.3028 11.8854C14.3124 11.8793 13.3813 11.4133 12.7824 10.6243C12.1838 9.83548 11.9857 8.81318 12.2461 7.85768C12.5068 6.90219 13.1966 6.12212 14.1129 5.74645C15.0291 5.37055 16.068 5.44214 16.9244 5.93956C17.7806 6.43699 18.3573 7.30426 18.4846 8.2864C18.6122 9.26854 18.2759 10.2542 17.5751 10.9537C16.9728 11.5559 16.1544 11.8914 15.3027 11.8853L15.3028 11.8854ZM15.3028 7.00782V7.00756C14.7444 7.00888 14.2231 7.28836 13.9133 7.75327C13.6037 8.21794 13.5461 8.80649 13.7601 9.32241C13.9738 9.83833 14.431 10.2137 14.9787 10.3231C15.5266 10.4322 16.0927 10.2613 16.4881 9.86686C16.803 9.55277 16.98 9.12669 16.9802 8.68185C16.9802 8.23726 16.8035 7.81089 16.4889 7.49683C16.1743 7.18277 15.7474 7.0068 15.3028 7.00759L15.3028 7.00782Z" fill="#1DA1F2" />
                                                            </svg>
                                                            <input type="hidden" name="school_group_id" id="" value="{{ request()->segment(2) }}">
                                                            <input name="name" id="name" class="text-input w-100 flex-1 mr-2" placeholder="New tag">




                                                        </div>
                                                        <button type="submit" class="btn btn-primary tags-input-text">
                                                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg" class="mx-1">
                                                                <path d="M6 0C5.58584 0 5.24997 0.335861 5.24997 0.750033V5.24997H0.750034C0.335874 5.24997 0 5.58565 0 6C0 6.41416 0.335861 6.75003 0.750034 6.75003H5.24997V11.25C5.24997 11.6641 5.58583 12 6 12C6.41418 12 6.75004 11.6641 6.75004 11.25V6.75003H11.25C11.6641 6.75003 12 6.41417 12 6C12 5.58583 11.6641 5.24997 11.25 5.24997H6.75004V0.750033C6.75004 0.335874 6.41435 0 6 0V0Z" fill="white"></path>
                                                            </svg>Add
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div> -->




                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <h6>My Webs</h6>
                        <div class="group-list-scroll-adjust">
                            @if (isset($mySubGroups))
                            @foreach ($mySubGroups as $mySubGroup)
                            @if (isset($mySubGroup->subGroup))
                            <!-- {{ route('group-chat-show',['subgroup' => $mySubGroup->subGroup->id]) }} -->

                            @php
                            $unseenMsg = App\Models\GroupChatSeen::whereUserId(auth()->user()->id)->whereSchoolSubGroupId($mySubGroup->subGroup->id)->whereSeen(0)->count();
                            @endphp

                            <a href="{{ route('group-chat-show',['subgroup' => $mySubGroup->subGroup->id]) }}" class="business-law-page d-flex justify-content-between">
                                <span class="d-flex">
                                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_120_1935)">
                                            <path d="M26.0789 14.5911L20.6889 12.11V5.0011C20.6864 4.85195 20.6411 4.70667 20.5583 4.58255C20.4756 4.45844 20.3589 4.36074 20.2222 4.3011L14.3889 1.61776C14.2865 1.57038 14.175 1.54584 14.0622 1.54584C13.9494 1.54584 13.8379 1.57038 13.7355 1.61776L7.90219 4.3011C7.76719 4.36358 7.65293 4.46346 7.57297 4.58891C7.49301 4.71436 7.45071 4.86011 7.45108 5.00887V12.1178L2.08441 14.5911C1.94941 14.6536 1.83515 14.7535 1.75519 14.8789C1.67524 15.0044 1.63294 15.1501 1.6333 15.2989V22.9055C1.63294 23.0543 1.67524 23.2001 1.75519 23.3255C1.83515 23.451 1.94941 23.5508 2.08441 23.6133L7.91775 26.2967C8.02013 26.344 8.1316 26.3686 8.24441 26.3686C8.35723 26.3686 8.4687 26.344 8.57108 26.2967L14.0777 23.7611L19.5844 26.2967C19.6868 26.344 19.7983 26.3686 19.9111 26.3686C20.0239 26.3686 20.1354 26.344 20.2377 26.2967L26.0711 23.6133C26.2061 23.5508 26.3203 23.451 26.4003 23.3255C26.4803 23.2001 26.5226 23.0543 26.5222 22.9055V15.2989C26.5232 15.151 26.4821 15.0058 26.4036 14.8804C26.3251 14.7551 26.2124 14.6547 26.0789 14.5911ZM23.8933 15.2989L19.9189 17.1111L15.9444 15.2989L19.9189 13.4711L23.8933 15.2989ZM14.0777 3.17332L18.0522 5.0011L14.0777 6.82887L10.1111 5.0011L14.0777 3.17332ZM8.24441 13.4633L12.2189 15.2911L8.24441 17.1111L4.26997 15.2989L8.24441 13.4633ZM13.3 22.4L8.24441 24.7333L3.18886 22.4V16.5122L7.91775 18.6667C8.01802 18.7117 8.1267 18.735 8.23664 18.735C8.34657 18.735 8.45526 18.7117 8.55553 18.6667L13.2844 16.4889L13.3 22.4ZM9.02219 12.11V6.22221L13.7511 8.39999C13.8535 8.44737 13.9649 8.47191 14.0777 8.47191C14.1906 8.47191 14.302 8.44737 14.4044 8.39999L19.1333 6.22221V12.1178L14.0777 14.4511L9.02219 12.11ZM24.9744 22.4078L19.9189 24.7411L14.8555 22.4078V16.5044L19.5922 18.6667C19.6914 18.7106 19.7987 18.7333 19.9072 18.7333C20.0157 18.7333 20.123 18.7106 20.2222 18.6667L24.9511 16.4889L24.9744 22.4078Z" fill="#1DA1F2" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_120_1935">
                                                <rect width="28" height="28" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <p>{{ $mySubGroup->subGroup->name }}</p>

                                    @if ($unseenMsg != 0)
                                    <span class="badge rounded-pill bg-danger ms-2 d-flex align-items-center">
                                        {{ $unseenMsg }}
                                    </span>
                                    @endif

                                </span>
                                <p>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.4302 5.92999L20.5002 12L14.4302 18.07" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M3.5 12H20.33" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </p>
                            </a>
                            @endif
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="right-sidebar">
                    <div class="right-sidebar-header d-flex">
                        <a href="#!" class="all-user-list">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.57 5.93005L3.5 12.0001L9.57 18.0701" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M20.4999 12H3.66992" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                        <h5 class="d-flex align-items-center mx-3">
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
                            <a id="chatUrl" href="" class="d-flex align-items-center">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.08317 15.8333H6.6665C3.33317 15.8333 1.6665 15 1.6665 10.8333V6.66663C1.6665 3.33329 3.33317 1.66663 6.6665 1.66663H13.3332C16.6665 1.66663 18.3332 3.33329 18.3332 6.66663V10.8333C18.3332 14.1666 16.6665 15.8333 13.3332 15.8333H12.9165C12.6582 15.8333 12.4082 15.9583 12.2498 16.1666L10.9998 17.8333C10.4498 18.5666 9.54984 18.5666 8.99984 17.8333L7.74984 16.1666C7.6165 15.9833 7.30817 15.8333 7.08317 15.8333Z" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M5.8335 6.66663H14.1668" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M5.8335 10.8334H10.8335" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                Message
                            </a>
                        </div>


                        <ul class="all-users">
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
                                <a href="#!" class="project-management d-flex align-items-center" onclick="showProfile('{{ $student->student->id }}','{{ $profile }}','{{ $student->student->first_name.' '.$student->student->last_name }}','{{ $student->student->email }}','{{ $student->student->country_code.' '.$student->student->contact }}')">
                                    <div class="user-thumb">
                                        <img src="{{ $profile }}" class="header-profile">

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
                                    <p>{{ $student->student->first_name.' '.$student->student->last_name }}</p>

                                    <!-- @if ($student->student->pending_chat_count != 0)
                                    <span class="badge rounded-pill bg-primary" id="">{{ $student->student->pending_chat_count }}</span>
                                    @endif -->
                                </a>
                                <!-- {{ route('chat.index') }} -->
                                <a href="{{ route('chat.show',['chat' => $student->student->id]) }}" class="message-chat">


                                    @if ($student->student->pending_chat_count != 0)
                                    <span class="badge rounded-pill bg-primary pending-chat-count-static">
                                        {{ $student->student->pending_chat_count }}
                                    </span>
                                    @endif

                                    <span class="badge rounded-pill bg-primary pending-chat-count  pending-chat-count-{{ $student->student->id }}">
                                    </span>



                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.08317 15.8333H6.6665C3.33317 15.8333 1.6665 15 1.6665 10.8333V6.66663C1.6665 3.33329 3.33317 1.66663 6.6665 1.66663H13.3332C16.6665 1.66663 18.3332 3.33329 18.3332 6.66663V10.8333C18.3332 14.1666 16.6665 15.8333 13.3332 15.8333H12.9165C12.6582 15.8333 12.4082 15.9583 12.2498 16.1666L10.9998 17.8333C10.4498 18.5666 9.54984 18.5666 8.99984 17.8333L7.74984 16.1666C7.6165 15.9833 7.30817 15.8333 7.08317 15.8333Z" stroke="#1DA1F2" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M5.8335 6.66663H14.1668" stroke="#1DA1F2" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M5.8335 10.8334H10.8335" stroke="#1DA1F2" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
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
    </div>
    </div>
</section>





@endsection


@section('js')
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
        $('#chatUrl').attr('href', 'javascript:void(0)');
        $('#chatUrl').attr('href', '{{ url("chat") }}/' + userid);
        $('#student-title').text('Student Information');
    }

    $('.all-user-list').click(function() {
        $('#student-title').text('Students');
        $('.all-user-list').hide();
    })

    function joinSubGroup(id) {
        $.ajax({
            url: "{{ route('school-sub-group-member.store') }}",
            method: "POST",
            data: {
                id: id
            },
            success: function(data) {
                if (data.status == true) {
                    location.reload();
                    // toastr.success(data.message);
                } else {
                    // location.reload();
                    toastr.error(data.message);
                }
            }
        })
    }


    $(document).ready(function() {
        $('#addTag').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "{{ route('school-sub-group.store') }}",
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        location.reload();
                    } else {
                        printErrorMsg(data.error);
                    }
                }
            })
        });

    });

    function printErrorMsg(msg) {

        if (msg.name != undefined && msg.name[0]) {
            toastr.error("The name has already been taken.");
        }

        if (msg.timeframe != undefined && msg.timeframe[0]) {
            toastr.error("The timeframe field is required.");
        }

    }
</script>
@endsection
