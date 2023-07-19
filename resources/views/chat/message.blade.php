@if ($messages)
@foreach ($messages as $message)
@if ($message->sender_id == Auth::id())
@if ($message->type == 4)
<div class="reciver-msg">
    <!-- <label for="">Me</label> -->
    <p class="msg to"> <a href="{{ $message->message }}">{{ $message->message }}</a></p>
</div>
@else
<div class="reciver-msg">
    <!-- <label for="">Me</label> -->
    <p class="msg to"> {{ $message->message }}</p>
</div>
@endif
@else
@if ($message->type == 4)
<div class="sender-msg">
    <!-- <label for="">{{ $message->first_name.' '.$message->last_name }}</label> -->
    <p class="msg to"> <a href="{{ $message->message }}">{{ $message->message }}</a> </p>
</div>
@else
<div class="sender-msg">
    <!-- <label for="">{{ $message->first_name.' '.$message->last_name }}</label> -->
    <p class="msg to"> {{ $message->message }}</p>
</div>
@endif
@endif
@endforeach
@endif

<script>
    // console.log('count');
    // $('.rounded-pill').text('30');
</script>
