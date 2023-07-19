@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-12">
            <div class="home-tab">

                <div class="tab-content tab-content-basic">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">

                        <div class="row">

                            @if (auth()->user()->role == config('constant.SCHOOLADMIN'))
                            <div class="col-lg-4 d-flex flex-column">
                                <a href="{{ route('user.index') }}">
                                    <div class="row flex-grow">
                                        <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                                            <div class="card bg-primary card-rounded">
                                                <div class="card-body pb-0">
                                                    <h4 class="card-title card-title-dash text-white mb-4">Students</h4>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <p class="status-summary-ight-white mb-1">Total</p>
                                                            <h2 class="text-info">{{ $studentCount }}</h2>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="status-summary-chart-wrapper pb-4">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endif

                            @if (auth()->user()->role == config('constant.SUPERADMIN'))
                            <div class="col-lg-4 d-flex flex-column">
                                <a href="{{ route('school.index') }}">
                                    <div class="row flex-grow">
                                        <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                                            <div class="card bg-success card-rounded">
                                                <div class="card-body pb-0">
                                                    <h4 class="card-title card-title-dash text-white mb-4">Schools</h4>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <p class="status-summary-ight-white mb-1">Total</p>
                                                            <h2 class="text-info">{{ $schoolCount }}</h2>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="status-summary-chart-wrapper pb-4">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endif

                            <!-- <div class="col-lg-4 d-flex flex-column">
                                <div class="row flex-grow">
                                    <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                                        <div class="card bg-primary card-rounded">
                                            <div class="card-body pb-0">
                                                <h4 class="card-title card-title-dash text-white mb-4">Groups</h4>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <p class="status-summary-ight-white mb-1">Total</p>
                                                        <h2 class="text-info">{{ $groupCount }}</h2>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="status-summary-chart-wrapper pb-4">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
