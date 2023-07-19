@if ($messages)
@foreach ($messages as $message)

@php
$total = App\Models\GroupChatReaction::whereGroupChatId($message->id)->whereSchoolSubGroupId($message->school_sub_group_id)->get();
$emojies = $total->groupBy('emoji')->map(function ($row) {
return $row->count();
});

$extension = pathinfo(storage_path($message->message), PATHINFO_EXTENSION);
@endphp



@if ($message->sender_id == Auth::id())
@if ($message->type == 2)
<div class="reciver-msg">

    <div class="audio-wrap">
        <div class="audio-title">
            <button type="button" class="btn download" onclick="downloadMedia('{{ fullImgUrl($message->message) }}','{{ $message->type }}','{{ $extension }}','{{ $message->original_file_name }}')">
                <!-- <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.7666 9.7334L9.89994 11.8667L12.0333 9.7334" stroke="#1DA1F2" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M9.90039 3.3335V11.8085" stroke="#1DA1F2" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M16.6663 10.1499C16.6663 13.8332 14.1663 16.8166 9.99967 16.8166C5.83301 16.8166 3.33301 13.8332 3.33301 10.1499" stroke="#1DA1F2" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Download -->
            </button>
        </div>

        <div class="d-flex align-items-center">
            <a href="#!" class="smiley-emoji" onclick="openEmojies('{{ $message->id }}')">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <mask id="path-1-inside-1_793_6757" fill="white">
                        <path d="M16 8C16 12.4185 12.4184 16 8 16C3.58192 16 0 12.4184 0 8C0 3.58192 3.58156 0 8 0C12.4185 0 16 3.58156 16 8Z" />
                    </mask>
                    <path d="M15.2462 8C15.2462 12.0021 12.0021 15.2462 8 15.2462V16.7538C12.8348 16.7538 16.7538 12.8348 16.7538 8H15.2462ZM8 15.2462C3.99823 15.2462 0.753843 12.0021 0.753843 8H-0.753843C-0.753843 12.8348 3.1656 16.7538 8 16.7538V15.2462ZM0.753843 8C0.753843 3.99823 3.99792 0.753843 8 0.753843V-0.753843C3.1652 -0.753843 -0.753843 3.1656 -0.753843 8H0.753843ZM8 0.753843C12.0021 0.753843 15.2462 3.99789 15.2462 8H16.7538C16.7538 3.16523 12.8348 -0.753843 8 -0.753843V0.753843Z" fill="black" mask="url(#path-1-inside-1_793_6757)" />
                    <path d="M5.10197 6.73653C5.10197 7.34009 4.61255 7.82927 4.00899 7.82927C3.40543 7.82927 2.91602 7.34009 2.91602 6.73653C2.91602 6.13278 3.40543 5.64355 4.00899 5.64355C4.61255 5.64355 5.10197 6.13274 5.10197 6.73653Z" fill="black" stroke="black" stroke-width="0.251281" stroke-miterlimit="10" />
                    <path d="M13.0863 6.73653C13.0863 7.34009 12.5969 7.82927 11.9934 7.82927C11.3898 7.82927 10.9004 7.34009 10.9004 6.73653C10.9004 6.13278 11.3898 5.64355 11.9934 5.64355C12.5969 5.64355 13.0863 6.13274 13.0863 6.73653Z" fill="black" stroke="black" stroke-width="0.251281" stroke-miterlimit="10" />
                    <path d="M3.82715 10.4121C4.53852 12.0096 6.14004 13.1264 8.00003 13.1264C9.8599 13.1264 11.4656 12.0096 12.1729 10.4121" stroke="black" stroke-width="0.502562" stroke-miterlimit="10" />
                </svg>
                <div id="emoji-picker" class="emoji-picker emoji-picker-{{ $message->id }}">
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128077;')">&#128077;</span>
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128079;')">&#128079;</span>
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#10067;')">&#10067;</span>
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#9989;')">&#9989;</span>
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128514;')">&#128514;</span>
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128522;')">&#128522;</span>
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#10071;')">&#10071;</span>
                </div>
            </a>
            <div class="audio-file">
                <audio controls="" src="{{ fullImgUrl($message->message) }}" id=""></audio>
                <ul class="badge-wrap" id="appendEmoji{{ $message->id }}">
                    @if (isset($emojies) && count($emojies) > 0)
                    @foreach ($emojies as $key => $emojie)
                    <li onclick="removeEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','{{ $key }}')">
                        <a href="#!" class=" badge">
                            <span>{{ $emojie }} {{ $key }}</span>
                        </a>
                    </li>
                    @endforeach
                    @endif
                </ul>
            </div>

        </div>




    </div>
</div>
@elseif ($message->type == 3)
<div class="reciver-msg">
    <div class="video-wrap">
        <div class="video-title">
            <button type="button" class="btn download" onclick="downloadMedia('{{ fullImgUrl($message->message) }}','{{ $message->type }}','{{ $extension }}','{{ $message->original_file_name }}')">
                <!-- <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.7666 9.7334L9.89994 11.8667L12.0333 9.7334" stroke="#1DA1F2" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M9.90039 3.3335V11.8085" stroke="#1DA1F2" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M16.6663 10.1499C16.6663 13.8332 14.1663 16.8166 9.99967 16.8166C5.83301 16.8166 3.33301 13.8332 3.33301 10.1499" stroke="#1DA1F2" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Download -->
            </button>
        </div>
        <div class="d-flex align-items-center">
            <a href="#!" class="smiley-emoji" onclick="openEmojies('{{ $message->id }}')">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <mask id="path-1-inside-1_793_6757" fill="white">
                        <path d="M16 8C16 12.4185 12.4184 16 8 16C3.58192 16 0 12.4184 0 8C0 3.58192 3.58156 0 8 0C12.4185 0 16 3.58156 16 8Z" />
                    </mask>
                    <path d="M15.2462 8C15.2462 12.0021 12.0021 15.2462 8 15.2462V16.7538C12.8348 16.7538 16.7538 12.8348 16.7538 8H15.2462ZM8 15.2462C3.99823 15.2462 0.753843 12.0021 0.753843 8H-0.753843C-0.753843 12.8348 3.1656 16.7538 8 16.7538V15.2462ZM0.753843 8C0.753843 3.99823 3.99792 0.753843 8 0.753843V-0.753843C3.1652 -0.753843 -0.753843 3.1656 -0.753843 8H0.753843ZM8 0.753843C12.0021 0.753843 15.2462 3.99789 15.2462 8H16.7538C16.7538 3.16523 12.8348 -0.753843 8 -0.753843V0.753843Z" fill="black" mask="url(#path-1-inside-1_793_6757)" />
                    <path d="M5.10197 6.73653C5.10197 7.34009 4.61255 7.82927 4.00899 7.82927C3.40543 7.82927 2.91602 7.34009 2.91602 6.73653C2.91602 6.13278 3.40543 5.64355 4.00899 5.64355C4.61255 5.64355 5.10197 6.13274 5.10197 6.73653Z" fill="black" stroke="black" stroke-width="0.251281" stroke-miterlimit="10" />
                    <path d="M13.0863 6.73653C13.0863 7.34009 12.5969 7.82927 11.9934 7.82927C11.3898 7.82927 10.9004 7.34009 10.9004 6.73653C10.9004 6.13278 11.3898 5.64355 11.9934 5.64355C12.5969 5.64355 13.0863 6.13274 13.0863 6.73653Z" fill="black" stroke="black" stroke-width="0.251281" stroke-miterlimit="10" />
                    <path d="M3.82715 10.4121C4.53852 12.0096 6.14004 13.1264 8.00003 13.1264C9.8599 13.1264 11.4656 12.0096 12.1729 10.4121" stroke="black" stroke-width="0.502562" stroke-miterlimit="10" />
                </svg>
                <div id="emoji-picker" class="emoji-picker emoji-picker-{{ $message->id }}">
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128077;')">&#128077;</span>
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128079;')">&#128079;</span>
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#10067;')">&#10067;</span>
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#9989;')">&#9989;</span>
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128514;')">&#128514;</span>
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128522;')">&#128522;</span>
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#10071;')">&#10071;</span>
                </div>
            </a>
            <div class="video">
                <!-- <iframe src="{{ fullImgUrl($message->message) }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe> -->
                <video width="500" height="315" controls="" src="{{ fullImgUrl($message->message) }}" id="videoPath"></video>
                <!-- <a href="#!"><img src="{{ asset('web/images/video-icon.png') }}"></a> -->
                <ul class="badge-wrap" id="appendEmoji{{ $message->id }}">
                    @if (isset($emojies) && count($emojies) > 0)
                    @foreach ($emojies as $key => $emojie)
                    <li onclick="removeEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','{{ $key }}')">
                        <a href="#!" class=" badge">
                            <span>{{ $emojie }} {{ $key }}</span>
                        </a>
                    </li>
                    @endforeach
                    @endif
                </ul>
            </div>

        </div>
    </div>
</div>
@elseif ($message->type == 4)
<div class="reciver-msg">

    <a href="#!" class="smiley-emoji" onclick="openEmojies('{{ $message->id }}')">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <mask id="path-1-inside-1_793_6757" fill="white">
                <path d="M16 8C16 12.4185 12.4184 16 8 16C3.58192 16 0 12.4184 0 8C0 3.58192 3.58156 0 8 0C12.4185 0 16 3.58156 16 8Z" />
            </mask>
            <path d="M15.2462 8C15.2462 12.0021 12.0021 15.2462 8 15.2462V16.7538C12.8348 16.7538 16.7538 12.8348 16.7538 8H15.2462ZM8 15.2462C3.99823 15.2462 0.753843 12.0021 0.753843 8H-0.753843C-0.753843 12.8348 3.1656 16.7538 8 16.7538V15.2462ZM0.753843 8C0.753843 3.99823 3.99792 0.753843 8 0.753843V-0.753843C3.1652 -0.753843 -0.753843 3.1656 -0.753843 8H0.753843ZM8 0.753843C12.0021 0.753843 15.2462 3.99789 15.2462 8H16.7538C16.7538 3.16523 12.8348 -0.753843 8 -0.753843V0.753843Z" fill="black" mask="url(#path-1-inside-1_793_6757)" />
            <path d="M5.10197 6.73653C5.10197 7.34009 4.61255 7.82927 4.00899 7.82927C3.40543 7.82927 2.91602 7.34009 2.91602 6.73653C2.91602 6.13278 3.40543 5.64355 4.00899 5.64355C4.61255 5.64355 5.10197 6.13274 5.10197 6.73653Z" fill="black" stroke="black" stroke-width="0.251281" stroke-miterlimit="10" />
            <path d="M13.0863 6.73653C13.0863 7.34009 12.5969 7.82927 11.9934 7.82927C11.3898 7.82927 10.9004 7.34009 10.9004 6.73653C10.9004 6.13278 11.3898 5.64355 11.9934 5.64355C12.5969 5.64355 13.0863 6.13274 13.0863 6.73653Z" fill="black" stroke="black" stroke-width="0.251281" stroke-miterlimit="10" />
            <path d="M3.82715 10.4121C4.53852 12.0096 6.14004 13.1264 8.00003 13.1264C9.8599 13.1264 11.4656 12.0096 12.1729 10.4121" stroke="black" stroke-width="0.502562" stroke-miterlimit="10" />
        </svg>
        <div id="emoji-picker" class="emoji-picker emoji-picker-{{ $message->id }}">
            <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128077;')">&#128077;</span>
            <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128079;')">&#128079;</span>
            <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#10067;')">&#10067;</span>
            <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#9989;')">&#9989;</span>
            <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128514;')">&#128514;</span>
            <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128522;')">&#128522;</span>
            <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#10071;')">&#10071;</span>
        </div>
    </a>

    <span class="msg to">
        <!-- <a target="_blank" href="{{ $message->start_url }}" style="color:#673ab7!important;">
            {{ $message->start_url }}
        </a> -->
        <a target="_blank" href="{{ $message->join_url }}" style="color:#673ab7!important;">
            {{ $message->join_url }}

            <ul class="badge-wrap" id="appendEmoji{{ $message->id }}">
                @if (isset($emojies) && count($emojies) > 0)
                @foreach ($emojies as $key => $emojie)
                <li onclick="removeEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','{{ $key }}')">
                    <a href="#!" class=" badge">
                        <span>{{ $emojie }} {{ $key }}</span>
                    </a>
                </li>
                @endforeach
                @endif
            </ul>


        </a>
    </span>
</div>
@elseif ($message->type == 5 || $message->type == 6)
<div class="reciver-msg">
    <div class="file-wrap">
        <div class="file-title">
            <button type="button" class="btn download" onclick="downloadMedia('{{ fullImgUrl($message->message) }}','{{ $message->type }}','{{ $extension }}','{{ $message->original_file_name }}')">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.7666 9.7334L9.89994 11.8667L12.0333 9.7334" stroke="#1DA1F2" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M9.90039 3.3335V11.8085" stroke="#1DA1F2" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M16.6663 10.1499C16.6663 13.8332 14.1663 16.8166 9.99967 16.8166C5.83301 16.8166 3.33301 13.8332 3.33301 10.1499" stroke="#1DA1F2" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Download
            </button>
        </div>
        <div class="d-flex align-items-center">
            <a href="#!" class="smiley-emoji" onclick="openEmojies('{{ $message->id }}')">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <mask id="path-1-inside-1_793_6757" fill="white">
                        <path d="M16 8C16 12.4185 12.4184 16 8 16C3.58192 16 0 12.4184 0 8C0 3.58192 3.58156 0 8 0C12.4185 0 16 3.58156 16 8Z" />
                    </mask>
                    <path d="M15.2462 8C15.2462 12.0021 12.0021 15.2462 8 15.2462V16.7538C12.8348 16.7538 16.7538 12.8348 16.7538 8H15.2462ZM8 15.2462C3.99823 15.2462 0.753843 12.0021 0.753843 8H-0.753843C-0.753843 12.8348 3.1656 16.7538 8 16.7538V15.2462ZM0.753843 8C0.753843 3.99823 3.99792 0.753843 8 0.753843V-0.753843C3.1652 -0.753843 -0.753843 3.1656 -0.753843 8H0.753843ZM8 0.753843C12.0021 0.753843 15.2462 3.99789 15.2462 8H16.7538C16.7538 3.16523 12.8348 -0.753843 8 -0.753843V0.753843Z" fill="black" mask="url(#path-1-inside-1_793_6757)" />
                    <path d="M5.10197 6.73653C5.10197 7.34009 4.61255 7.82927 4.00899 7.82927C3.40543 7.82927 2.91602 7.34009 2.91602 6.73653C2.91602 6.13278 3.40543 5.64355 4.00899 5.64355C4.61255 5.64355 5.10197 6.13274 5.10197 6.73653Z" fill="black" stroke="black" stroke-width="0.251281" stroke-miterlimit="10" />
                    <path d="M13.0863 6.73653C13.0863 7.34009 12.5969 7.82927 11.9934 7.82927C11.3898 7.82927 10.9004 7.34009 10.9004 6.73653C10.9004 6.13278 11.3898 5.64355 11.9934 5.64355C12.5969 5.64355 13.0863 6.13274 13.0863 6.73653Z" fill="black" stroke="black" stroke-width="0.251281" stroke-miterlimit="10" />
                    <path d="M3.82715 10.4121C4.53852 12.0096 6.14004 13.1264 8.00003 13.1264C9.8599 13.1264 11.4656 12.0096 12.1729 10.4121" stroke="black" stroke-width="0.502562" stroke-miterlimit="10" />
                </svg>
                <div id="emoji-picker" class="emoji-picker emoji-picker-{{ $message->id }}">
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128077;')">&#128077;</span>
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128079;')">&#128079;</span>
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#10067;')">&#10067;</span>
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#9989;')">&#9989;</span>
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128514;')">&#128514;</span>
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128522;')">&#128522;</span>
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#10071;')">&#10071;</span>
                </div>
            </a>
            <span class="file-share mb-2">
                <ul class="badge-wrap" id="appendEmoji{{ $message->id }}">
                    @if (isset($emojies) && count($emojies) > 0)
                    @foreach ($emojies as $key => $emojie)
                    <li onclick="removeEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','{{ $key }}')">
                        <a href="#!" class=" badge">
                            <span>{{ $emojie }} {{ $key }}</span>
                        </a>
                    </li>
                    @endforeach
                    @endif
                </ul>
                <span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.5993 5.70153L16.035 2.13724C15.9469 2.04931 15.8276 2 15.7034 2H5.56345C5.1489 2.00043 4.75157 2.16531 4.45844 2.45844C4.16529 2.75158 4.0004 3.1489 4 3.56345V20.4365C4.00043 20.8511 4.16531 21.2484 4.45844 21.5416C4.75158 21.8347 5.1489 21.9996 5.56345 22H18.1729C18.5874 21.9996 18.9847 21.8347 19.2779 21.5416C19.571 21.2484 19.7359 20.8511 19.7363 20.4365V6.03331C19.7363 5.9089 19.6869 5.78962 19.5991 5.70169L19.5993 5.70153ZM18.173 21.0624H5.56363C5.3976 21.0623 5.23856 20.9963 5.12113 20.8789C5.00385 20.7614 4.93772 20.6024 4.93758 20.4364V3.56329C4.93772 3.39726 5.00385 3.23822 5.12113 3.12079C5.23856 3.00336 5.3976 2.93739 5.56363 2.93724H15.2347V4.93721C15.2352 5.35176 15.4 5.74908 15.6932 6.04222C15.9862 6.33536 16.3836 6.50026 16.7982 6.50066H18.7982V20.4362C18.798 20.6021 18.7322 20.7611 18.6149 20.8784C18.4977 20.9958 18.3388 21.0619 18.173 21.0624L18.173 21.0624ZM17.2913 7.62707C17.2913 7.75148 17.2419 7.87076 17.1539 7.95868C17.066 8.04661 16.9469 8.09592 16.8225 8.09592H6.91349C6.78752 8.09863 6.66567 8.05046 6.5756 7.96224C6.48554 7.87403 6.43466 7.75332 6.43466 7.6272C6.43466 7.50108 6.48554 7.38038 6.5756 7.29216C6.66567 7.20395 6.78752 7.15578 6.91349 7.15849H16.8232C17.082 7.15849 17.2918 7.36826 17.2919 7.62707L17.2913 7.62707ZM17.2913 10.3449V10.345C17.2912 10.6038 17.0813 10.8136 16.8224 10.8136H6.91347C6.7875 10.8163 6.66565 10.7681 6.57559 10.6799C6.48552 10.5917 6.43464 10.471 6.43464 10.3449C6.43464 10.2187 6.48552 10.098 6.57559 10.0098C6.66565 9.92161 6.7875 9.87344 6.91347 9.87615H16.8232C17.082 9.87615 17.2919 10.0861 17.2919 10.345L17.2913 10.3449ZM17.2913 13.0625V13.0626C17.2913 13.1869 17.2419 13.3062 17.1539 13.3941C17.066 13.482 16.9469 13.5314 16.8225 13.5314H6.91349C6.78752 13.5341 6.66567 13.4859 6.5756 13.3977C6.48554 13.3096 6.43466 13.1888 6.43466 13.0626C6.43466 12.9367 6.48554 12.8158 6.5756 12.7277C6.66567 12.6395 6.78752 12.5914 6.91349 12.5941H16.8232C17.082 12.5941 17.2918 12.8037 17.2919 13.0626L17.2913 13.0625ZM17.2913 15.7803V15.7804C17.2912 16.0392 17.0813 16.249 16.8224 16.249H6.91347C6.7875 16.2517 6.66565 16.2036 6.57559 16.1153C6.48552 16.0273 6.43464 15.9064 6.43464 15.7803C6.43464 15.6543 6.48552 15.5335 6.57559 15.4453C6.66565 15.3572 6.7875 15.3089 6.91347 15.3116H16.8232C17.082 15.3116 17.2919 15.5215 17.2919 15.7805L17.2913 15.7803ZM17.2913 18.4979V18.4981C17.2913 18.6225 17.2419 18.7416 17.1539 18.8296C17.066 18.9175 16.9469 18.9669 16.8225 18.9669H6.91349C6.78752 18.9696 6.66567 18.9215 6.5756 18.8333C6.48554 18.745 6.43466 18.6243 6.43466 18.4982C6.43466 18.3721 6.48554 18.2514 6.5756 18.1632C6.66567 18.075 6.78752 18.0268 6.91349 18.0295H16.8232C17.082 18.0295 17.2918 18.2393 17.2919 18.4981L17.2913 18.4979Z" fill="#1DA1F2" />
                    </svg>
                </span>
                <span>{{ $message->original_file_name }}</span>

            </span>


        </div>
    </div>
</div>
@else
<div class="reciver-msg">

    <a href="#!" class="smiley-emoji" onclick="openEmojies('{{ $message->id }}')">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <mask id="path-1-inside-1_793_6757" fill="white">
                <path d="M16 8C16 12.4185 12.4184 16 8 16C3.58192 16 0 12.4184 0 8C0 3.58192 3.58156 0 8 0C12.4185 0 16 3.58156 16 8Z" />
            </mask>
            <path d="M15.2462 8C15.2462 12.0021 12.0021 15.2462 8 15.2462V16.7538C12.8348 16.7538 16.7538 12.8348 16.7538 8H15.2462ZM8 15.2462C3.99823 15.2462 0.753843 12.0021 0.753843 8H-0.753843C-0.753843 12.8348 3.1656 16.7538 8 16.7538V15.2462ZM0.753843 8C0.753843 3.99823 3.99792 0.753843 8 0.753843V-0.753843C3.1652 -0.753843 -0.753843 3.1656 -0.753843 8H0.753843ZM8 0.753843C12.0021 0.753843 15.2462 3.99789 15.2462 8H16.7538C16.7538 3.16523 12.8348 -0.753843 8 -0.753843V0.753843Z" fill="black" mask="url(#path-1-inside-1_793_6757)" />
            <path d="M5.10197 6.73653C5.10197 7.34009 4.61255 7.82927 4.00899 7.82927C3.40543 7.82927 2.91602 7.34009 2.91602 6.73653C2.91602 6.13278 3.40543 5.64355 4.00899 5.64355C4.61255 5.64355 5.10197 6.13274 5.10197 6.73653Z" fill="black" stroke="black" stroke-width="0.251281" stroke-miterlimit="10" />
            <path d="M13.0863 6.73653C13.0863 7.34009 12.5969 7.82927 11.9934 7.82927C11.3898 7.82927 10.9004 7.34009 10.9004 6.73653C10.9004 6.13278 11.3898 5.64355 11.9934 5.64355C12.5969 5.64355 13.0863 6.13274 13.0863 6.73653Z" fill="black" stroke="black" stroke-width="0.251281" stroke-miterlimit="10" />
            <path d="M3.82715 10.4121C4.53852 12.0096 6.14004 13.1264 8.00003 13.1264C9.8599 13.1264 11.4656 12.0096 12.1729 10.4121" stroke="black" stroke-width="0.502562" stroke-miterlimit="10" />
        </svg>
        <div id="emoji-picker" class="emoji-picker emoji-picker-{{ $message->id }}">
            <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128077;')">&#128077;</span>
            <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128079;')">&#128079;</span>
            <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#10067;')">&#10067;</span>
            <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#9989;')">&#9989;</span>
            <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128514;')">&#128514;</span>
            <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128522;')">&#128522;</span>
            <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#10071;')">&#10071;</span>
        </div>
    </a>

    @if (filter_var($message->message, FILTER_VALIDATE_URL))
    <span class="msg to">
        <a target="_blank" href="{{ $message->message }}" style="color:#673ab7!important;">
            {{ $message->message }}
        </a>
        <ul class="badge-wrap" id="appendEmoji{{ $message->id }}" style="display: flex;">
            @if (isset($emojies) && count($emojies) > 0)
            @foreach ($emojies as $key => $emojie)
            <li onclick="removeEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','{{ $key }}')">
                <a href="#!" class=" badge">
                    <span>{{ $emojie }} {{ $key }}</span>
                </a>
            </li>
            @endforeach
            @endif
        </ul>
    </span>
    @else
    <span class="msg to">


        {{ $message->message }}
        <ul class="badge-wrap" id="appendEmoji{{ $message->id }}">
            @if (isset($emojies) && count($emojies) > 0)
            @foreach ($emojies as $key => $emojie)
            <li onclick="removeEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','{{ $key }}')">
                <a href="#!" class="badge">
                    <span>{{ $emojie }} {{ $key }}</span>
                </a>
            </li>
            @endforeach
            @endif
        </ul>




    </span>

    @endif
</div>
@endif


@else


@if ($message->type == 2)
<div class="sender-msg">
    <div class="audio-wrap">
        <div class="audio-title mt-3">
            <label for="">{{ $message->first_name.' '.$message->last_name }}</label>
            <button type="button" class="btn download" onclick="downloadMedia('{{ fullImgUrl($message->message) }}','{{ $message->type }}','{{ $extension }}','{{ $message->original_file_name }}')">
                <!-- <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.7666 9.7334L9.89994 11.8667L12.0333 9.7334" stroke="#1DA1F2" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M9.90039 3.3335V11.8085" stroke="#1DA1F2" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M16.6663 10.1499C16.6663 13.8332 14.1663 16.8166 9.99967 16.8166C5.83301 16.8166 3.33301 13.8332 3.33301 10.1499" stroke="#1DA1F2" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Download -->
            </button>
        </div>
        <div class="d-flex align-items-center">

            <div class="audio-file">
                <audio controls="" src="{{ fullImgUrl($message->message) }}" id=""></audio>
                <ul class="badge-wrap" id="appendEmoji{{ $message->id }}">
                    @if (isset($emojies) && count($emojies) > 0)
                    @foreach ($emojies as $key => $emojie)
                    <li onclick="removeEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','{{ $key }}')">
                        <a href="#!" class=" badge">
                            <span>{{ $emojie }} {{ $key }}</span>
                        </a>
                    </li>
                    @endforeach
                    @endif
                </ul>
            </div>
            <a href="#!" class="smiley-emoji" onclick="openEmojies('{{ $message->id }}')">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <mask id="path-1-inside-1_793_6757" fill="white">
                        <path d="M16 8C16 12.4185 12.4184 16 8 16C3.58192 16 0 12.4184 0 8C0 3.58192 3.58156 0 8 0C12.4185 0 16 3.58156 16 8Z" />
                    </mask>
                    <path d="M15.2462 8C15.2462 12.0021 12.0021 15.2462 8 15.2462V16.7538C12.8348 16.7538 16.7538 12.8348 16.7538 8H15.2462ZM8 15.2462C3.99823 15.2462 0.753843 12.0021 0.753843 8H-0.753843C-0.753843 12.8348 3.1656 16.7538 8 16.7538V15.2462ZM0.753843 8C0.753843 3.99823 3.99792 0.753843 8 0.753843V-0.753843C3.1652 -0.753843 -0.753843 3.1656 -0.753843 8H0.753843ZM8 0.753843C12.0021 0.753843 15.2462 3.99789 15.2462 8H16.7538C16.7538 3.16523 12.8348 -0.753843 8 -0.753843V0.753843Z" fill="black" mask="url(#path-1-inside-1_793_6757)" />
                    <path d="M5.10197 6.73653C5.10197 7.34009 4.61255 7.82927 4.00899 7.82927C3.40543 7.82927 2.91602 7.34009 2.91602 6.73653C2.91602 6.13278 3.40543 5.64355 4.00899 5.64355C4.61255 5.64355 5.10197 6.13274 5.10197 6.73653Z" fill="black" stroke="black" stroke-width="0.251281" stroke-miterlimit="10" />
                    <path d="M13.0863 6.73653C13.0863 7.34009 12.5969 7.82927 11.9934 7.82927C11.3898 7.82927 10.9004 7.34009 10.9004 6.73653C10.9004 6.13278 11.3898 5.64355 11.9934 5.64355C12.5969 5.64355 13.0863 6.13274 13.0863 6.73653Z" fill="black" stroke="black" stroke-width="0.251281" stroke-miterlimit="10" />
                    <path d="M3.82715 10.4121C4.53852 12.0096 6.14004 13.1264 8.00003 13.1264C9.8599 13.1264 11.4656 12.0096 12.1729 10.4121" stroke="black" stroke-width="0.502562" stroke-miterlimit="10" />
                </svg>
                <div id="emoji-picker" class="emoji-picker emoji-picker-{{ $message->id }}">
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128077;')">&#128077;</span>
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128079;')">&#128079;</span>
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#10067;')">&#10067;</span>
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#9989;')">&#9989;</span>
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128514;')">&#128514;</span>
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128522;')">&#128522;</span>
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#10071;')">&#10071;</span>
                </div>
            </a>
        </div>
    </div>
</div>
@elseif ($message->type == 3)
<div class="sender-msg">
    <div class="video-wrap">
        <div class="video-title">
            <label class="" for="">{{ $message->first_name.' '.$message->last_name }}</label>
            <button type="button" class="btn download" onclick="downloadMedia('{{ fullImgUrl($message->message) }}','{{ $message->type }}','{{ $extension }}','{{ $message->original_file_name }}')">
                <!-- <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.7666 9.7334L9.89994 11.8667L12.0333 9.7334" stroke="#1DA1F2" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M9.90039 3.3335V11.8085" stroke="#1DA1F2" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M16.6663 10.1499C16.6663 13.8332 14.1663 16.8166 9.99967 16.8166C5.83301 16.8166 3.33301 13.8332 3.33301 10.1499" stroke="#1DA1F2" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Download -->
            </button>
        </div>
        <div class="d-flex align-items-center">
            <div class="video">
                <!-- <iframe src="{{ fullImgUrl($message->message) }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe> -->
                <!-- <a href="#!"><img src="{{ asset('web/images/video-icon.png') }}"></a> -->
                <video width="500" height="315" controls="" src="{{ fullImgUrl($message->message) }}" id="videoPath"></video>
                <ul class="badge-wrap" id="appendEmoji{{ $message->id }}">
                    @if (isset($emojies) && count($emojies) > 0)
                    @foreach ($emojies as $key => $emojie)
                    <li onclick="removeEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','{{ $key }}')">
                        <a href="#!" class=" badge">
                            <span>{{ $emojie }} {{ $key }}</span>
                        </a>
                    </li>
                    @endforeach
                    @endif
                </ul>
            </div>
            <a href="#!" class="smiley-emoji" onclick="openEmojies('{{ $message->id }}')">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <mask id="path-1-inside-1_793_6757" fill="white">
                        <path d="M16 8C16 12.4185 12.4184 16 8 16C3.58192 16 0 12.4184 0 8C0 3.58192 3.58156 0 8 0C12.4185 0 16 3.58156 16 8Z" />
                    </mask>
                    <path d="M15.2462 8C15.2462 12.0021 12.0021 15.2462 8 15.2462V16.7538C12.8348 16.7538 16.7538 12.8348 16.7538 8H15.2462ZM8 15.2462C3.99823 15.2462 0.753843 12.0021 0.753843 8H-0.753843C-0.753843 12.8348 3.1656 16.7538 8 16.7538V15.2462ZM0.753843 8C0.753843 3.99823 3.99792 0.753843 8 0.753843V-0.753843C3.1652 -0.753843 -0.753843 3.1656 -0.753843 8H0.753843ZM8 0.753843C12.0021 0.753843 15.2462 3.99789 15.2462 8H16.7538C16.7538 3.16523 12.8348 -0.753843 8 -0.753843V0.753843Z" fill="black" mask="url(#path-1-inside-1_793_6757)" />
                    <path d="M5.10197 6.73653C5.10197 7.34009 4.61255 7.82927 4.00899 7.82927C3.40543 7.82927 2.91602 7.34009 2.91602 6.73653C2.91602 6.13278 3.40543 5.64355 4.00899 5.64355C4.61255 5.64355 5.10197 6.13274 5.10197 6.73653Z" fill="black" stroke="black" stroke-width="0.251281" stroke-miterlimit="10" />
                    <path d="M13.0863 6.73653C13.0863 7.34009 12.5969 7.82927 11.9934 7.82927C11.3898 7.82927 10.9004 7.34009 10.9004 6.73653C10.9004 6.13278 11.3898 5.64355 11.9934 5.64355C12.5969 5.64355 13.0863 6.13274 13.0863 6.73653Z" fill="black" stroke="black" stroke-width="0.251281" stroke-miterlimit="10" />
                    <path d="M3.82715 10.4121C4.53852 12.0096 6.14004 13.1264 8.00003 13.1264C9.8599 13.1264 11.4656 12.0096 12.1729 10.4121" stroke="black" stroke-width="0.502562" stroke-miterlimit="10" />
                </svg>
                <div id="emoji-picker" class="emoji-picker emoji-picker-{{ $message->id }}">
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128077;')">&#128077;</span>
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128079;')">&#128079;</span>
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#10067;')">&#10067;</span>
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#9989;')">&#9989;</span>
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128514;')">&#128514;</span>
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128522;')">&#128522;</span>
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#10071;')">&#10071;</span>
                </div>
            </a>
        </div>
    </div>
</div>
@elseif ($message->type == 4)
<div class="sender-msg">
    <label for="">{{ $message->first_name.' '.$message->last_name }}</label>
    <span class="msg to">
        <a target="_blank" href="{{ $message->join_url }}" style="color:#673ab7!important;">
            {{ $message->join_url }}
        </a>
        <ul class="badge-wrap" id="appendEmoji{{ $message->id }}">
            @if (isset($emojies) && count($emojies) > 0)
            @foreach ($emojies as $key => $emojie)
            <li onclick="removeEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','{{ $key }}')">
                <a href="#!" class=" badge">
                    <span>{{ $emojie }} {{ $key }}</span>
                </a>
            </li>
            @endforeach
            @endif
        </ul>

    </span>
    <a href="#!" class="smiley-emoji" onclick="openEmojies('{{ $message->id }}')">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <mask id="path-1-inside-1_793_6757" fill="white">
                <path d="M16 8C16 12.4185 12.4184 16 8 16C3.58192 16 0 12.4184 0 8C0 3.58192 3.58156 0 8 0C12.4185 0 16 3.58156 16 8Z" />
            </mask>
            <path d="M15.2462 8C15.2462 12.0021 12.0021 15.2462 8 15.2462V16.7538C12.8348 16.7538 16.7538 12.8348 16.7538 8H15.2462ZM8 15.2462C3.99823 15.2462 0.753843 12.0021 0.753843 8H-0.753843C-0.753843 12.8348 3.1656 16.7538 8 16.7538V15.2462ZM0.753843 8C0.753843 3.99823 3.99792 0.753843 8 0.753843V-0.753843C3.1652 -0.753843 -0.753843 3.1656 -0.753843 8H0.753843ZM8 0.753843C12.0021 0.753843 15.2462 3.99789 15.2462 8H16.7538C16.7538 3.16523 12.8348 -0.753843 8 -0.753843V0.753843Z" fill="black" mask="url(#path-1-inside-1_793_6757)" />
            <path d="M5.10197 6.73653C5.10197 7.34009 4.61255 7.82927 4.00899 7.82927C3.40543 7.82927 2.91602 7.34009 2.91602 6.73653C2.91602 6.13278 3.40543 5.64355 4.00899 5.64355C4.61255 5.64355 5.10197 6.13274 5.10197 6.73653Z" fill="black" stroke="black" stroke-width="0.251281" stroke-miterlimit="10" />
            <path d="M13.0863 6.73653C13.0863 7.34009 12.5969 7.82927 11.9934 7.82927C11.3898 7.82927 10.9004 7.34009 10.9004 6.73653C10.9004 6.13278 11.3898 5.64355 11.9934 5.64355C12.5969 5.64355 13.0863 6.13274 13.0863 6.73653Z" fill="black" stroke="black" stroke-width="0.251281" stroke-miterlimit="10" />
            <path d="M3.82715 10.4121C4.53852 12.0096 6.14004 13.1264 8.00003 13.1264C9.8599 13.1264 11.4656 12.0096 12.1729 10.4121" stroke="black" stroke-width="0.502562" stroke-miterlimit="10" />
        </svg>
        <div id="emoji-picker" class="emoji-picker emoji-picker-{{ $message->id }}">
            <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128077;')">&#128077;</span>
            <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128079;')">&#128079;</span>
            <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#10067;')">&#10067;</span>
            <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#9989;')">&#9989;</span>
            <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128514;')">&#128514;</span>
            <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128522;')">&#128522;</span>
            <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#10071;')">&#10071;</span>
        </div>
    </a>
</div>
@elseif ($message->type == 5 || $message->type == 6)
<div class="sender-msg">
    <div class="file-wrap">
        <div class="file-title">
            <label for="">{{ $message->first_name.' '.$message->last_name }}</label>
            <button type="button" class="btn download" onclick="downloadMedia('{{ fullImgUrl($message->message) }}','{{ $message->type }}','{{ $extension }}','{{ $message->original_file_name }}')">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.7666 9.7334L9.89994 11.8667L12.0333 9.7334" stroke="#1DA1F2" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M9.90039 3.3335V11.8085" stroke="#1DA1F2" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M16.6663 10.1499C16.6663 13.8332 14.1663 16.8166 9.99967 16.8166C5.83301 16.8166 3.33301 13.8332 3.33301 10.1499" stroke="#1DA1F2" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Download
            </button>
        </div>
        <div class="d-flex align-items-center">
            <span class="file-share">

                <span>
                    <ul class="badge-wrap" id="appendEmoji{{ $message->id }}">
                        @if (isset($emojies) && count($emojies) > 0)
                        @foreach ($emojies as $key => $emojie)
                        <li onclick="removeEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','{{ $key }}')">
                            <a href="#!" class=" badge">
                                <span>{{ $emojie }} {{ $key }}</span>
                            </a>
                        </li>
                        @endforeach
                        @endif
                    </ul>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.5993 5.70153L16.035 2.13724C15.9469 2.04931 15.8276 2 15.7034 2H5.56345C5.1489 2.00043 4.75157 2.16531 4.45844 2.45844C4.16529 2.75158 4.0004 3.1489 4 3.56345V20.4365C4.00043 20.8511 4.16531 21.2484 4.45844 21.5416C4.75158 21.8347 5.1489 21.9996 5.56345 22H18.1729C18.5874 21.9996 18.9847 21.8347 19.2779 21.5416C19.571 21.2484 19.7359 20.8511 19.7363 20.4365V6.03331C19.7363 5.9089 19.6869 5.78962 19.5991 5.70169L19.5993 5.70153ZM18.173 21.0624H5.56363C5.3976 21.0623 5.23856 20.9963 5.12113 20.8789C5.00385 20.7614 4.93772 20.6024 4.93758 20.4364V3.56329C4.93772 3.39726 5.00385 3.23822 5.12113 3.12079C5.23856 3.00336 5.3976 2.93739 5.56363 2.93724H15.2347V4.93721C15.2352 5.35176 15.4 5.74908 15.6932 6.04222C15.9862 6.33536 16.3836 6.50026 16.7982 6.50066H18.7982V20.4362C18.798 20.6021 18.7322 20.7611 18.6149 20.8784C18.4977 20.9958 18.3388 21.0619 18.173 21.0624L18.173 21.0624ZM17.2913 7.62707C17.2913 7.75148 17.2419 7.87076 17.1539 7.95868C17.066 8.04661 16.9469 8.09592 16.8225 8.09592H6.91349C6.78752 8.09863 6.66567 8.05046 6.5756 7.96224C6.48554 7.87403 6.43466 7.75332 6.43466 7.6272C6.43466 7.50108 6.48554 7.38038 6.5756 7.29216C6.66567 7.20395 6.78752 7.15578 6.91349 7.15849H16.8232C17.082 7.15849 17.2918 7.36826 17.2919 7.62707L17.2913 7.62707ZM17.2913 10.3449V10.345C17.2912 10.6038 17.0813 10.8136 16.8224 10.8136H6.91347C6.7875 10.8163 6.66565 10.7681 6.57559 10.6799C6.48552 10.5917 6.43464 10.471 6.43464 10.3449C6.43464 10.2187 6.48552 10.098 6.57559 10.0098C6.66565 9.92161 6.7875 9.87344 6.91347 9.87615H16.8232C17.082 9.87615 17.2919 10.0861 17.2919 10.345L17.2913 10.3449ZM17.2913 13.0625V13.0626C17.2913 13.1869 17.2419 13.3062 17.1539 13.3941C17.066 13.482 16.9469 13.5314 16.8225 13.5314H6.91349C6.78752 13.5341 6.66567 13.4859 6.5756 13.3977C6.48554 13.3096 6.43466 13.1888 6.43466 13.0626C6.43466 12.9367 6.48554 12.8158 6.5756 12.7277C6.66567 12.6395 6.78752 12.5914 6.91349 12.5941H16.8232C17.082 12.5941 17.2918 12.8037 17.2919 13.0626L17.2913 13.0625ZM17.2913 15.7803V15.7804C17.2912 16.0392 17.0813 16.249 16.8224 16.249H6.91347C6.7875 16.2517 6.66565 16.2036 6.57559 16.1153C6.48552 16.0273 6.43464 15.9064 6.43464 15.7803C6.43464 15.6543 6.48552 15.5335 6.57559 15.4453C6.66565 15.3572 6.7875 15.3089 6.91347 15.3116H16.8232C17.082 15.3116 17.2919 15.5215 17.2919 15.7805L17.2913 15.7803ZM17.2913 18.4979V18.4981C17.2913 18.6225 17.2419 18.7416 17.1539 18.8296C17.066 18.9175 16.9469 18.9669 16.8225 18.9669H6.91349C6.78752 18.9696 6.66567 18.9215 6.5756 18.8333C6.48554 18.745 6.43466 18.6243 6.43466 18.4982C6.43466 18.3721 6.48554 18.2514 6.5756 18.1632C6.66567 18.075 6.78752 18.0268 6.91349 18.0295H16.8232C17.082 18.0295 17.2918 18.2393 17.2919 18.4981L17.2913 18.4979Z" fill="#1DA1F2" />
                    </svg>
                </span>

                <span>{{ $message->original_file_name }}</span>

            </span>

            <a href="#!" class="smiley-emoji" onclick="openEmojies('{{ $message->id }}')">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <mask id="path-1-inside-1_793_6757" fill="white">
                        <path d="M16 8C16 12.4185 12.4184 16 8 16C3.58192 16 0 12.4184 0 8C0 3.58192 3.58156 0 8 0C12.4185 0 16 3.58156 16 8Z" />
                    </mask>
                    <path d="M15.2462 8C15.2462 12.0021 12.0021 15.2462 8 15.2462V16.7538C12.8348 16.7538 16.7538 12.8348 16.7538 8H15.2462ZM8 15.2462C3.99823 15.2462 0.753843 12.0021 0.753843 8H-0.753843C-0.753843 12.8348 3.1656 16.7538 8 16.7538V15.2462ZM0.753843 8C0.753843 3.99823 3.99792 0.753843 8 0.753843V-0.753843C3.1652 -0.753843 -0.753843 3.1656 -0.753843 8H0.753843ZM8 0.753843C12.0021 0.753843 15.2462 3.99789 15.2462 8H16.7538C16.7538 3.16523 12.8348 -0.753843 8 -0.753843V0.753843Z" fill="black" mask="url(#path-1-inside-1_793_6757)" />
                    <path d="M5.10197 6.73653C5.10197 7.34009 4.61255 7.82927 4.00899 7.82927C3.40543 7.82927 2.91602 7.34009 2.91602 6.73653C2.91602 6.13278 3.40543 5.64355 4.00899 5.64355C4.61255 5.64355 5.10197 6.13274 5.10197 6.73653Z" fill="black" stroke="black" stroke-width="0.251281" stroke-miterlimit="10" />
                    <path d="M13.0863 6.73653C13.0863 7.34009 12.5969 7.82927 11.9934 7.82927C11.3898 7.82927 10.9004 7.34009 10.9004 6.73653C10.9004 6.13278 11.3898 5.64355 11.9934 5.64355C12.5969 5.64355 13.0863 6.13274 13.0863 6.73653Z" fill="black" stroke="black" stroke-width="0.251281" stroke-miterlimit="10" />
                    <path d="M3.82715 10.4121C4.53852 12.0096 6.14004 13.1264 8.00003 13.1264C9.8599 13.1264 11.4656 12.0096 12.1729 10.4121" stroke="black" stroke-width="0.502562" stroke-miterlimit="10" />
                </svg>
                <div id="emoji-picker" class="emoji-picker emoji-picker-{{ $message->id }}">
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128077;')">&#128077;</span>
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128079;')">&#128079;</span>
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#10067;')">&#10067;</span>
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#9989;')">&#9989;</span>
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128514;')">&#128514;</span>
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128522;')">&#128522;</span>
                    <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#10071;')">&#10071;</span>
                </div>
            </a>
        </div>
    </div>
</div>
@else
<div class="sender-msg mt-3">


    <label for="">{{ $message->first_name.' '.$message->last_name }}</label>

    @if (filter_var($message->message, FILTER_VALIDATE_URL))
    <span class="msg to">
        <a target="_blank" href="{{ $message->message }}" style="color:#673ab7!important;">{{ $message->message }}</a>
        <ul class="badge-wrap" id="appendEmoji{{ $message->id }}" style="display: flex;">
            @if (isset($emojies) && count($emojies) > 0)
            @foreach ($emojies as $key => $emojie)
            <li onclick="removeEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','{{ $key }}')">
                <a href="#!" class=" badge">
                    <span>{{ $emojie }} {{ $key }}</span>
                </a>
            </li>
            @endforeach
            @endif
        </ul>

    </span>
    <a href="#!" class="smiley-emoji" onclick="openEmojies('{{ $message->id }}')">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <mask id="path-1-inside-1_793_6757" fill="white">
                <path d="M16 8C16 12.4185 12.4184 16 8 16C3.58192 16 0 12.4184 0 8C0 3.58192 3.58156 0 8 0C12.4185 0 16 3.58156 16 8Z" />
            </mask>
            <path d="M15.2462 8C15.2462 12.0021 12.0021 15.2462 8 15.2462V16.7538C12.8348 16.7538 16.7538 12.8348 16.7538 8H15.2462ZM8 15.2462C3.99823 15.2462 0.753843 12.0021 0.753843 8H-0.753843C-0.753843 12.8348 3.1656 16.7538 8 16.7538V15.2462ZM0.753843 8C0.753843 3.99823 3.99792 0.753843 8 0.753843V-0.753843C3.1652 -0.753843 -0.753843 3.1656 -0.753843 8H0.753843ZM8 0.753843C12.0021 0.753843 15.2462 3.99789 15.2462 8H16.7538C16.7538 3.16523 12.8348 -0.753843 8 -0.753843V0.753843Z" fill="black" mask="url(#path-1-inside-1_793_6757)" />
            <path d="M5.10197 6.73653C5.10197 7.34009 4.61255 7.82927 4.00899 7.82927C3.40543 7.82927 2.91602 7.34009 2.91602 6.73653C2.91602 6.13278 3.40543 5.64355 4.00899 5.64355C4.61255 5.64355 5.10197 6.13274 5.10197 6.73653Z" fill="black" stroke="black" stroke-width="0.251281" stroke-miterlimit="10" />
            <path d="M13.0863 6.73653C13.0863 7.34009 12.5969 7.82927 11.9934 7.82927C11.3898 7.82927 10.9004 7.34009 10.9004 6.73653C10.9004 6.13278 11.3898 5.64355 11.9934 5.64355C12.5969 5.64355 13.0863 6.13274 13.0863 6.73653Z" fill="black" stroke="black" stroke-width="0.251281" stroke-miterlimit="10" />
            <path d="M3.82715 10.4121C4.53852 12.0096 6.14004 13.1264 8.00003 13.1264C9.8599 13.1264 11.4656 12.0096 12.1729 10.4121" stroke="black" stroke-width="0.502562" stroke-miterlimit="10" />
        </svg>
        <div id="emoji-picker" class="emoji-picker emoji-picker-{{ $message->id }}">
            <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128077;')">&#128077;</span>
            <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128079;')">&#128079;</span>
            <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#10067;')">&#10067;</span>
            <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#9989;')">&#9989;</span>
            <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128514;')">&#128514;</span>
            <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128522;')">&#128522;</span>
            <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#10071;')">&#10071;</span>
        </div>
    </a>


    @else
    <span class="msg to">
        <ul class="badge-wrap" id="appendEmoji{{ $message->id }}">
            @if (isset($emojies) && count($emojies) > 0)
            @foreach ($emojies as $key => $emojie)
            <li onclick="removeEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','{{ $key }}')">
                <a href="#!" class=" badge">
                    <span>{{ $emojie }} {{ $key }}</span>
                </a>
            </li>
            @endforeach
            @endif
        </ul>
        {{ $message->message }}
    </span>

    <a href="#!" class="smiley-emoji" onclick="openEmojies('{{ $message->id }}')">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <mask id="path-1-inside-1_793_6757" fill="white">
                <path d="M16 8C16 12.4185 12.4184 16 8 16C3.58192 16 0 12.4184 0 8C0 3.58192 3.58156 0 8 0C12.4185 0 16 3.58156 16 8Z" />
            </mask>
            <path d="M15.2462 8C15.2462 12.0021 12.0021 15.2462 8 15.2462V16.7538C12.8348 16.7538 16.7538 12.8348 16.7538 8H15.2462ZM8 15.2462C3.99823 15.2462 0.753843 12.0021 0.753843 8H-0.753843C-0.753843 12.8348 3.1656 16.7538 8 16.7538V15.2462ZM0.753843 8C0.753843 3.99823 3.99792 0.753843 8 0.753843V-0.753843C3.1652 -0.753843 -0.753843 3.1656 -0.753843 8H0.753843ZM8 0.753843C12.0021 0.753843 15.2462 3.99789 15.2462 8H16.7538C16.7538 3.16523 12.8348 -0.753843 8 -0.753843V0.753843Z" fill="black" mask="url(#path-1-inside-1_793_6757)" />
            <path d="M5.10197 6.73653C5.10197 7.34009 4.61255 7.82927 4.00899 7.82927C3.40543 7.82927 2.91602 7.34009 2.91602 6.73653C2.91602 6.13278 3.40543 5.64355 4.00899 5.64355C4.61255 5.64355 5.10197 6.13274 5.10197 6.73653Z" fill="black" stroke="black" stroke-width="0.251281" stroke-miterlimit="10" />
            <path d="M13.0863 6.73653C13.0863 7.34009 12.5969 7.82927 11.9934 7.82927C11.3898 7.82927 10.9004 7.34009 10.9004 6.73653C10.9004 6.13278 11.3898 5.64355 11.9934 5.64355C12.5969 5.64355 13.0863 6.13274 13.0863 6.73653Z" fill="black" stroke="black" stroke-width="0.251281" stroke-miterlimit="10" />
            <path d="M3.82715 10.4121C4.53852 12.0096 6.14004 13.1264 8.00003 13.1264C9.8599 13.1264 11.4656 12.0096 12.1729 10.4121" stroke="black" stroke-width="0.502562" stroke-miterlimit="10" />
        </svg>
        <div id="emoji-picker" class="emoji-picker emoji-picker-{{ $message->id }}">
            <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128077;')">&#128077;</span>
            <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128079;')">&#128079;</span>
            <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#10067;')">&#10067;</span>
            <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#9989;')">&#9989;</span>
            <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128514;')">&#128514;</span>
            <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#128522;')">&#128522;</span>
            <span onclick="setEmoji('{{ $message->id }}','{{ $message->school_sub_group_id }}','&#10071;')">&#10071;</span>
        </div>
    </a>

    @endif



</div>
@endif
@endif
@endforeach
@endif


<!-- <script>
    console.log('count');
    $('.rounded-pill').text('30');
</script> -->
