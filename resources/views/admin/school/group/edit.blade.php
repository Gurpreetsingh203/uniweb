@extends('admin.layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $title }} form</h4>
                    <p class="card-description">
                        {{ $title }} form layout
                    </p>
                    <form action="{{ route('group.update',['group' => $group->id]) }}" method="post" class="forms-sample" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <input type="hidden" name="school_id" value="{{ $group->school_id }}">
                        <div class="form-group">
                            <label for="exampleInputUsername1">Name</label>
                            <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" placeholder="Name" value="{{ $group->name }}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
