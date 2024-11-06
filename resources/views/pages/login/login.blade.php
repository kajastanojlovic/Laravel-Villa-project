@extends('layouts.layout')

@section('pageTitle') Login  @endsection

@section('description') Log in into your account.  @endsection

@section('keyword') login, user @endsection


@section('content')
    <div class="contact-page section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 ">
                    <div class="row">
                        <div class="col-lg-6 mx-auto">
                            <fieldset>
                                @if(session('error'))
                                    <div class="alert alert-danger rounded-error">
                                    {{session('error')}}</div>
                                @endif
                            </fieldset>
                        </div>
                    </div>
                    <form id="contact-form" action="{{route('login.store')}}" method="POST">
                        @csrf
                        <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-lg-12">
                                    <fieldset>
                                        <label for="email">Email Address</label>
                                        <input type="text" name="email" id="email"  placeholder="Your E-mail...">
                                        @error('email')
                                            <p class="alert alert-danger">{{$message}}</p>
                                        @enderror
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" placeholder="Password..."  >
                                        @error('password')
                                        <p class="alert alert-danger">{{$message}}</p>
                                        @enderror
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <button type="submit" id="form-submit" class="orange-button">Login</button><hr/>
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <label>You don't have account?</label><br>
                                        <a href="{{route('register.create')}}" class="register" >
                                            <button type="button" class="orange-button">Register</button></a>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
