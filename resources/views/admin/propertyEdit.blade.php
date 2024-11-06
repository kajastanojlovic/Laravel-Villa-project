@extends('layouts.layout')

@section('pageTitle') Edit property  @endsection

@section('description')  Edit property.  @endsection

@section('keyword') online, edit, property @endsection

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
                    <form id="contact-form" action="{{route('property.update', $prop->first()->idRealEstate)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            @foreach($prop as $p)
                                <div class="col-lg-12">
                                    <fieldset>
                                        <label for="total_space">Total space</label>
                                        <input type="number" name="total_space" id="total_space" value="{{$p->total_space}}" placeholder="Total space..." autocomplete="on" >
                                        @error('total_space')
                                        <div class="alert alert-danger rounded-error">{{$message}}</div>
                                        @enderror
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <label for="number_of_bathrooms">Number of bathrooms</label>
                                        <input name="number_of_bathrooms" id="number_of_bathrooms" value="{{$p->number_of_bathrooms}}" placeholder="Bathrooms..." autocomplete="on" >
                                        @error('number_of_bathrooms')
                                        <div class="alert alert-danger rounded-error">{{$message}}</div>
                                        @enderror
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <label for="number_of_bedrooms">Number of bedrooms</label>
                                        <input type="number" name="number_of_bedrooms" id="number_of_bedrooms" value="{{$p->number_of_bedrooms}}" placeholder="Bedrooms..."  autocomplete="on">
                                        @error('number_of_bedrooms')
                                        <div class="alert alert-danger rounded-error">{{$message}}</div>
                                        @enderror
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <label for="number_of_floors">Number of floors</label>
                                        <input type="number" name="number_of_floors" id="number_of_floors" placeholder="Floors..." value="{{$p->number_of_floors}}" autocomplete="on">
                                        @error('number_of_floors')
                                        <div class="alert alert-danger rounded-error">{{ $message }}</div>
                                        @enderror
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <label for="type_id">Real estate type</label>
                                        <select name="type_id" id="type_id" class="form-select">
                                            <option value="0">Choose...</option>
                                            @foreach($ddl as $d)
                                                @if($d->id == $p->type_id)
                                                    <option value="{{$d->id}}" selected >{{$d->type}}</option>
                                                @else
                                                    <option value="{{$d->id}}" >{{$d->type}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('type_id')
                                        <div class="alert alert-danger rounded-error">{{$message}}</div>
                                        @enderror
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <label for="garage_spaces">Garage spaces</label>
                                        <input  type="number" name="garage_spaces" id="garage_spaces" value="{{$p->garage_spaces}}">
                                        @error('garage_spaces')
                                        <div class="alert alert-danger rounded-error">{{$message}}</div>
                                        @enderror
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <label for="has_a_pool">Has a pool</label><br>

                                        <label class="radio" for="has_a_pool1" >Yes</label>
                                        <input class="radio" type="radio" name="has_a_pool" value="1" id="has_a_pool1"
                                               @if($p->has_a_pool==1) checked @endif ><br>

                                        <label class="radio" for="has_a_pool2" >No</label>
                                        <input class="radio" type="radio" name="has_a_pool" value="0" id="has_a_pool2"
                                               @if($p->has_a_pool==0) checked @endif >


                                        @error('has_a_pool')
                                        <div class="alert alert-danger rounded-error">{{ $message }}</div>
                                        @enderror
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <label for="numbers_of_balcony">Number of balconies </label>
                                        <input type="number" name="numbers_of_balcony" id="numbers_of_balcony" value="{{$p->numbers_of_balcony}}">
                                        @error('numbers_of_balcony')
                                        <div class="alert alert-danger rounded-error">{{ $message }}</div>
                                        @enderror
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <label for="year_built">Year built </label>
                                        <input type="number" name="year_built" id="year_built" placeholder="Year built..." value="{{$p->year_built}}">
                                        @error('year_built')
                                        <div class="alert alert-danger rounded-error">{{ $message }}</div>
                                        @enderror
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <label for="agreement_type">Agreement type (cnd,sfr or asd) </label>
                                        <input type="text" name="agreement_type" id="agreement_type"  placeholder="Choose cnd,sfr or asd..."
                                               value="{{$p->agreement_type}}">
                                        @error('agreement_type')
                                        <div class="alert alert-danger rounded-error">{{ $message }}</div>
                                        @enderror
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <label for="price" >Price</label>
                                        <input type="number" id="price" name="price" class="form-control" placeholder="Price..."
                                               value="{{(int)$p->price}}"/>
                                        @error('price')
                                        <div class="alert alert-danger rounded-error">{{ $message }}</div>
                                        @enderror
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <label for="image" >Add image</label>
                                        <input type="file" class="form-control "  id="image" name="image" />
                                        @error('image')
                                        <div class="alert alert-danger rounded-error">{{ $message }}</div>
                                        @enderror
                                    </fieldset>
                                </div>

                            @endforeach

                            <div class="col-lg-12">
                                <fieldset>
                                    <button type="submit" id="form-submit" class="orange-button">Edit</button>
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
