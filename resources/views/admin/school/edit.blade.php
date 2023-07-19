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
                    <form action="{{ route('school.update',['school' => $school->id]) }}" method="post" class="forms-sample" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="exampleInputUsername1">Name</label>
                            <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" placeholder="Name" value="{{ $school->name }}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <!-- <div class="form-group">
                            <label for="exampleInputUsername1">Firstname</label>
                            <input type="text" name="first_name" class="form-control  @error('first_name') is-invalid @enderror" placeholder="Firstname" value="{{ $school->first_name }}">
                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">Lastname</label>
                            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" placeholder="Lastname" value="{{ $school->last_name }}">
                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div> -->
                        <div class="form-group">
                            <label for="exampleInputUsername1">Contact</label>
                            <input type="text" name="contact" class="form-control @error('contact') is-invalid @enderror" placeholder="Contact" value="{{ $school->contact }}">
                            @error('contact')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" name="address">{{ $school->address }}</textarea>
                            @error('address')
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
