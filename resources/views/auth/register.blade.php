@extends('layouts.app')

@section('content')

    @push('style')

    @endpush
    <style>
        body{
            font-size: 14px;
        }
        .form-control-feedback{
            color: red;
        }
        #location_latitude-error{
            text-align: center;
            color: #fff;
            background-color: #f66e84;
            border-color: #f55f78;
            /*padding: 0.7rem;*/
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 1rem;
        }
    </style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Register</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" id="general-form">
                        @csrf
                        <input type="hidden" class="form-control" name="location_latitude" id="location_latitude">
                        <input type="hidden" class="form-control" name="location_longitude" id="location_longitude">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Your name" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email Address <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Your email address" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Date of birth <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <input id="birth_date" type="text" class="form-control m_datepicker_1 @error('birth_date') is-invalid @enderror" name="birth_date" value="{{ old('birth_date') }}" placeholder="Your birth date" required autocomplete="birth_date" autofocus>
                                @error('birth_date')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">Select Gender <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <select class="form-control @error('gender') is-invalid @enderror" name="gender" required>
                                    <option value="">--------Select--------</option>
                                    <option value="1" {{ app()->request->gender == 1 ? 'selected' : '' }}>Male</option>
                                    <option value="2" {{ app()->request->gender == 2 ? 'selected' : '' }}>Female</option>
                                    <option value="0">Other</option>
                                </select>
                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Type password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Re-type password" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="userImage" class="col-md-4 col-form-label text-md-right">Upload Photo</label>
                            <div class="col-md-6">
                                <input id="user_image" type="file" class="form-control-file" name="user_image" value="{{ old('user_image') }}" placeholder="Your birth date" autocomplete="user_image" autofocus>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        //date picker
        $(document).ready(function() {
            $(".m_datepicker_1").datepicker( {
                todayHighlight: !0,
                orientation: "bottom left",
                format: 'yyyy-mm-dd'
            });

        });

        $(function() {
            if (navigator.geolocation) {
                navigator.geolocation.watchPosition(showPosition);
            } else {
                alert('Geolocation is not supported by this browser')
            }
        });

        function showPosition(position) {
            if (position.coords.latitude > 0 && position.coords.longitude >0){
                    $('#location_latitude').val(position.coords.latitude);
                    $('#location_longitude').val(position.coords.longitude);
            }else {
                alert('Error to take location info')
            }
            console.log('Lat-'+ position.coords.latitude);
            console.log('Lan-'+ position.coords.longitude);
            /* x.innerHTML="Latitude: " + position.coords.latitude +
                 "<br>Longitude: " + position.coords.longitude;*/
        }

        //form validation
        $('#general-form').validate({
            rules:{
                name: {
                    required: true,
                },
                email: {
                    required: true,
                },
                birth_date: {
                    required: true,
                },
                gender: {
                    required: true,
                    min: 1,
                },
                password: {
                    required: true,
                },
                password_confirmation: {
                    required: true,
                },
                location_latitude: {
                    required: true,
                },
            },

            messages: {
                name:{
                    required: 'Name field is require'
                },
                email:{
                    required: 'Email field is require'
                },
                birth_date:{
                    required: 'Barth date field is require'
                },
                gender:{
                    required: 'Gender is field require'
                },
                password:{
                    required: 'Password is field require'
                },

                password_confirmation:{
                    required: 'Password confirm is field require'
                },
                location_latitude:{
                    required: 'Please refresh browser or try again in a new tab and allow browser to take you location info'
                },
            }
        });


    </script>
@endpush
