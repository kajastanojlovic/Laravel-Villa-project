@extends('layouts.layout')

@section('pageTitle') Contact  @endsection

@section('description') Contact for any question.  @endsection

@section('keyword') online, contact, user @endsection

@section('content')

    <div class="contact-page section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 ">
                    <div class="row">
                        <div class="col-lg-6">
                            <form id="contact-form" action="{{route('schedule.visit',['id'=>auth()->user()->id])}}" method="POST">
                                @csrf
                                <div class="row">

                                    <div class="col-lg-12">
                                        <fieldset>
                                            @if(session('error'))
                                                <div class="alert alert-danger rounded-error">{{session('error')}}</div>
                                            @endif

                                            @if(session('success'))
                                                <div class="alert alert-success">{{session('success')}}</div>
                                            @endif
                                        </fieldset>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="col-lg-12">
                                            <fieldset>
                                                <label for="startDate">Check visit date</label>
                                                <input id="startDate" class="form-control" type="date" name="visit_date"/>
                                                @error('visit_date')
                                                <p class="alert alert-danger">{{$message}}</p>
                                                @enderror
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-12">
                                            <fieldset>
                                                <label for="visit_time">Check visit time</label>
                                                <input id="visit_time" class="form-control" type="time" name="visit_time"/>
                                                @error('visit_time')
                                                <p class="alert alert-danger">{{$message}}</p>
                                                @enderror
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-12">
                                            <fieldset>
                                                <button type="submit" id="form-submit" class="orange-button">Schedule visit</button>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
