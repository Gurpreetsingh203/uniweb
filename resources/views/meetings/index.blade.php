@extends('admin.layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('group.create',['school' => Request::get('school')]) }}">
                        <button type="button" class="btn btn-primary mb-5">
                            <i class="mdi mdi-library-plus"></i>
                        </button>
                    </a>
                    <div class="justify-between">
                        <a href="{{ route('meetings.create') }}">
                            {{ __('Create Meeting') }}
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table data-table" id="">
                            <thead>
                                <tr>
                                    <th>{{ __('Host ID') }}</th>
                                    <th>{{ __('Topic') }}</th>
                                    <th>{{ __('Meeting Type') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Start Time') }}</th>
                                    <th>{{ __('Duration') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($meetings as $meeting)
                                    <tr>
                                        <td>
                                            {{ $meeting->host_id }}
                                        </td>
                                        <td>
                                            {{ $meeting->topic }}
                                        </td>
                                        <td>
                                            {{ $meeting->meeting_type }}
                                        </td>
                                        <td>
                                            {{ $meeting->status }}
                                        </td>
                                        <td>
                                            {{ $meeting->start_time }}
                                        </td>
                                        <td>
                                            {{ $meeting->meeting_duration }}
                                        </td>
                                        <td>
                                            <a href=""> {{ __('Meeting Details') }}</a>
                                            <a href=""> {{ __('Join Meeting') }}</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>
                                            {{ __('No Record Found!')}}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection