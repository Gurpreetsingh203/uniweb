@extends('admin.layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $title }} form</h4>
                    <p class="card-description">
                        <!-- {{ $title }} form layout -->
                        Note: When you create a new school, It will automatically send the password to the entered school email.
                    </p>
                    <form action="{{ route('school.store') }}" method="post" class="forms-sample" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="exampleInputUsername1">Name</label>
                            <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" placeholder="name" value="{{ old('name') }}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <!-- <div class="form-group">
                            <label for="exampleInputUsername1">Firstname</label>
                            <input type="text" name="first_name" class="form-control  @error('first_name') is-invalid @enderror" placeholder="Firstname" value="{{ old('first_name') }}">
                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">Lastname</label>
                            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" placeholder="Lastname" value="{{ old('last_name') }}">
                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div> -->
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Contact</label>
                            <input type="number" name="contact" class="form-control @error('contact') is-invalid @enderror" placeholder="Contact" value="{{ old('contact') }}">
                            @error('contact')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" name="address">{{ old('address') }}</textarea>
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
