@extends('admin.layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"> {{ __('Form') }}</h4>
                    <form action="{{ route('meetings.store') }}"
                        method="post"
                        class="forms-sample"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $code }}" name="code">
                        <div class="form-group">
                            <label for="topic">{{ __('Topic') }}</label>
                            <input type="text"
                                name="topic"
                                class="form-control"
                                placeholder="Enter Topic"
                                value="{{ old('topic') }}">
                        </div>
                        <div class="form-group">
                            <label for="description">{{ __('Description') }}</label>
                            <input type="text"
                                name="description"
                                class="form-control"
                                placeholder="Enter Description"
                                value="{{ old('description') }}">
                        </div>
                        <div class="form-group">
                            <label for="timezone">{{ __('Timezone') }}</label>
                            <select
                                id="timezone"
                                name="timezone"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded
                                focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                                <option value="" placeholder="Select timezone">{{ __('Select timezone') }}</option>
                                @foreach ($timezones as $key => $timezone)
                                    <option value="{{ $timezone->id }}" {{ old("timezone") == $timezone->id ? 'selected' : '' }}>
                                        {{ $timezone->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Duration">{{ __('Duration') }}</label>
                            <input type="number"
                                name="duration"
                                class="form-control"
                                placeholder="Enter Duration in minutes"
                                value="{{ old('duration', '00:00:00') }}">
                        </div>
                        <div class="form-group">
                            <label for="start_time">{{ __('Start Time') }}</label>
                            <input type="datetime-local"
                                name="start_time"
                                class="form-control"
                                placeholder="Enter Start Time"
                                value="{{ old('start_time') }}">
                        </div>
                        <div class="form-group">
                            <label for="type">{{ __('Meeting Type') }}</label>
                            <div>
                                <input
                                    id="type-audio"
                                    type="radio"
                                    name="type"
                                    value="1"
                                    {{ old('type') == 'audio' ? 'checked' : '' }}>
                                <label for="type-audio">{{ __('Audio') }}</label>
                            </div>
                            <div>
                                <input
                                    id="type-video"
                                    type="radio"
                                    name="type"
                                    value="2"
                                    {{ old('type') == 'video' ? 'checked' : '' }}>
                                <label for="type-video">{{ __('Video') }}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <input type="password"
                                name="password"
                                class="form-control"
                                placeholder="Enter Meeting Password"
                                value="{{ old('password') }}">
                        </div>
                        <button type="submit" class="btn btn-primary me-2">
                            {{ __('Submit') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
