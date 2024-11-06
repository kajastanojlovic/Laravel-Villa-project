@extends('layouts.layout')

@section('pageTitle') Register  @endsection

@section('description') Register to website.  @endsection

@section('keyword') online, register, user @endsection

@section('content')
    <div class="contact-page section">
        <div class="container">
            <div class="row justify-content-center">
            <div class="col-lg-6 ">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <fieldset>
                            @if(session('error'))
                                <div class="alert alert-danger rounded-error">{{session('error')}}</div>
                            @endif

                            @if(session('success'))
                                <div class="alert alert-success">{{session('success')}}</div>
                            @endif
                        </fieldset>
                    </div>
                </div>
                <form id="contact-form" action="{{route('register.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <fieldset>
                                <label for="first_name">First Name</label>
                                <input name="first_name" id="first_name" value="{{old('first_name')}}" placeholder="Your First Name..." autocomplete="on" >
                                @error('first_name')
                                <div class="alert alert-danger rounded-error">{{$message}}</div>
                                @enderror
                            </fieldset>
                        </div>
                        <div class="col-lg-12">
                            <fieldset>
                                <label for="last_name">Last Name</label>
                                <input name="last_name" id="last_name" value="{{old('last_name')}}" placeholder="Your Last Name..." autocomplete="on" >
                                @error('last_name')
                                <div class="alert alert-danger rounded-error">{{$message}}</div>
                                @enderror
                            </fieldset>
                        </div>
                        <div class="col-lg-12">
                            <fieldset>
                                <label for="email">Email Address</label>
                                <input type="text" name="email" id="email" value="{{old('email')}}" placeholder="Your E-mail..." autocomplete="on">
                                @error('email')
                                <div class="alert alert-danger rounded-error">{{$message}}</div>
                                @enderror
                            </fieldset>
                        </div>
                        <div class="col-lg-12">
                            <fieldset>
                                <label for="number">Phone number</label>
                                <input name="number" id="number" placeholder="Number..." value="{{old('number')}}" autocomplete="on">
                                @error('number')
                                <div class="alert alert-danger rounded-error">{{ $message }}</div>
                                @enderror
                            </fieldset>
                        </div>
                        <div class="col-lg-12">
                            <fieldset>
                                <label for="address">Address</label>
                                <input name="address" id="address" placeholder="Address..." value="{{old('address')}}" autocomplete="on">
                                @error('address')
                                <div class="alert alert-danger rounded-error">{{$message}}</div>
                                @enderror
                            </fieldset>
                        </div>
                        <div class="col-lg-12">
                            <fieldset>
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" placeholder="Password..." autocomplete="on" >
                                @error('password')
                                <div class="alert alert-danger rounded-error">{{$message}}</div>
                                @enderror
                                {{--u register mogu da stavim confirm password--}}
                            </fieldset>
                        </div>
                        <div class="col-lg-12">
                            <fieldset>
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm password..." autocomplete="on" >
                                @error('password_confirmation')
                                <div class="alert alert-danger rounded-error">{{ $message }}</div>
                                @enderror
                            </fieldset>
                        </div>
                        <div class="col-lg-12">
                            <fieldset>
                                <button type="submit" id="form-submit" class="orange-button">Register</button>
                            </fieldset>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>

@endsection
