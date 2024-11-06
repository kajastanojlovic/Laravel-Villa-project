@extends('layouts.layout')

@section('pageTitle') Properties  @endsection

@section('description') Look at our offer.  @endsection

@section('keyword') properties, real estate, user @endsection

@section('content')

    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <span class="breadcrumb"><a href="#">Home</a> / Properties</span>
                    <h3>Properties</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="section properties">
        <div class="container">
            <ul class="properties-filter" id="filterForm">
                <li>
                    <a class="is_active" href="#!" data-filter="*">Show All</a>
                </li>
                @foreach($type as $t)
                    <li>
                        <a href="#!" data-id="{{$t->id}}">{{$t->type}}</a>
                    </li>
                @endforeach

            </ul>
            <ul class="properties-filter">
                @if(auth()->check() && auth()->user()->role_id==2)
                <li >
                    <a href="{{route('property.create')}}"  class="addProp">Add New Property</a>
                </li>
                @endif
{{--                #E2D1BF--}}
            </ul>
            @if(session('error'))
                <div class="alert alert-danger rounded-error">{{session('error')}}</div>
            @endif
            @if(session('success'))
                <div class="alert alert-success rounded-error">{{session('success')}}</div>
            @endif
            <div class="row properties-box">

                @foreach($prop as $p)
                <div class="col-lg-4 col-md-6 align-self-center mb-30 properties-items col-md-6 adv">
                    <div class="item">
                        <a href="#"><img src="{{asset('assets/images/' . $p->image)}}" alt=""></a>

                            <span class="category">{{$p->type->type}}</span>

                        <h6>${{$p->price}}</h6>
                        <h4><a href="#">{{$p->city->address_number}} {{ $p->city->address}}</a></h4>
                        <h4><a href="#">{{$p->city->state->state}}</a></h4>
                        <ul>
                            <li>Bedrooms: <span>{{$p->number_of_bedrooms}}</span></li>
                            <li>Bathrooms: <span>{{$p->number_of_bathrooms}}</span></li>
                            <li>Total space: <span>{{$p->total_space}} SqFt</span></li>
                            <li>Floors: <span>{{$p->number_of_floors}}</span></li>
                        </ul>
                        <div class="main-button">
{{--                            @if(auth()->check())--}}
{{--                                @if( auth()->user()->role_id==3 || auth()->user()->role_id==2)--}}
                                    <a href="{{route('property.show', ['id'=>$p->id])}}">Property Details</a>
{{--                                @endif--}}
{{--                            @endif--}}
                            @if( auth()->check() && auth()->user()->role_id == 2)
                                   <form action="{{route('property.delete', $p->id)}}" method="POST">
                                       @csrf
                                        @method('delete')
                                      <button type="submit" class="link-danger">Delete Property</button>
                                   </form>
                            @endif
                            @if( auth()->check() && auth()->user()->role_id == 2)
                                <a href="{{route('property.edit', $p->id)}}" class="link-success">Edit Property </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 ">

                    {{$prop->links()}}

            </div>
        </div>
        </div>



@endsection

{{--@section('script')--}}
{{--    <script>--}}
{{--       --}}
{{--    </script>--}}

{{--@endsection--}}
