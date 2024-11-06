@extends('layouts.layout')

@section('pageTitle') Properties details  @endsection

@section('description') More details about properties.  @endsection

@section('keyword') properties, details, real estate, user @endsection

@section('content')

<div class="page-heading header-text">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <span class="breadcrumb"><a href="#">Home</a>  /  Single Property</span>
                <h3>Single Property</h3>
            </div>
        </div>
    </div>
</div>
<div class="section best-deal">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="section-heading">
                    <h6>| Best Deal</h6>
                    <h2>Find Your Best Deal Right Now!</h2>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="tabs-content">
                    <div class="row">
{{--                        @foreach($prop as $prop)--}}
{{--                        @if(auth()->check())--}}
                        <div class="nav-wrapper ">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="appartment-tab" data-bs-toggle="tab" data-bs-target="#appartment" type="button" role="tab" aria-controls="appartment" aria-selected="true">
                                        {{$prop->type->type}}
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="appartment" role="tabpanel" aria-labelledby="appartment-tab">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="info-table">
                                            <ul>
                                                <li>Total Flat Space <span>{{$prop->total_space}} SqFt</span></li>
                                                <li>Floors <span>{{$prop->number_of_floors}}</span></li>
                                                <li>Number of rooms <span>{{$prop->number_of_bedrooms}}</span></li>
                                                <li>Number of bathrooms <span>{{$prop->number_of_bathrooms}}</span></li>
                                                 @if($prop->has_a_pool == '1')
                                                    <li>Pool <span>Yes</span></li>
                                                @else
                                                    <li>Pool <span>No</span></li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <img src="{{asset('/assets/images/' . $prop->image)}}" alt="">
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="info-table">
                                            <ul>
                                                <li>Total price <span>${{$prop->price}} </span></li>
                                                <li>Floors <span>{{$prop->number_of_floors}}</span></li>
                                                <li>Number of balconies <span>{{$prop->details->numbers_of_balcony}}</span></li>
                                                <li>Year built <span>{{$prop->details->year_built}}</span></li>
                                                <li>Agreement type <span>{{$prop->details->agreement_type}}</span></li>
                                            </ul>
                                        </div>
                                        <div class="icon-button">
{{--                                            <form action="{{route('schedule.visit',$prop->id)}}" method="post" id="visitForm">--}}
{{--                                                @csrf--}}
{{--                                                <a href="#" onclick="event.preventDefault();--}}
{{--                                                document.getElementById('visitForm').submit();"><i class="fa fa-calendar"></i> Schedule a visit</a>--}}
{{--                                            </form>--}}
                                            @if(auth()->check() && auth()->user()->role_id==3)
                                            <a href="{{route('schedule.visit.create')}}"><i class="fa fa-calendar"></i> Schedule a visit</a>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
{{--                            @endif--}}
{{--                            @endforeach--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
