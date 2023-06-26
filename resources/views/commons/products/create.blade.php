@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h1>{{ __('Nouvelle requête pour tester') }}</h1>

                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                @endif

                <form action="{{ route('ride-request.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="user">{{ __("ID")}}</label>
                        <input type="text" name="user" id="user" value="{{ auth()->user()->id }}" class="form-control" required readonly />
                        @error('user')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="rider">{{ __("Livreur")}}</label>
                        <select name="rider" id="rider" class="form-control @error('rider') is-invalid @enderror">
                            @foreach($riders as $rider)
                                <option value="{{ $rider->id }}"> {{ $rider->name }} </option>
                            @endforeach
                        </select>
                        @error('rider')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="start_latitude">{{ __("Coordonnée depart (latitude)")}}</label>
                        <input type="text" name="start_latitude" id="start_latitude" class="form-control @error('start_latitude') is-invalid @enderror"/>
                        @error('start_latitude')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="start_longitude">{{ __("Coordonnée depart (longitude)")}}</label>
                        <input type="text" name="start_longitude" id="start_longitude" class="form-control @error('start_longitude') is-invalid @enderror"/>
                        @error('start_longitude')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="destination_latitude">{{ __("Coordonnée arrivée (latitude)")}}</label>
                        <input type="text" name="destination_latitude" id="destination_latitude" class="form-control @error('destination_latitude') is-invalid @enderror"/>
                        @error('destination_latitude')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="destination_longitude">{{ __("Coordonnée arrivée (longitude)")}}</label>
                        <input type="text" name="destination_longitude" id="destination_longitude" class="form-control @error('destination_longitude') is-invalid @enderror"/>
                        @error('destination_longitude')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="ride_price">{{ __("Prix de la course")}}</label>
                        <input type="text" name="ride_price" id="ride_price" class="form-control @error('ride_price') is-invalid @enderror"/>
                        @error('ride_price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="ride_distance">{{ __("Distance de la course")}}</label>
                        <input type="text" name="ride_distance" id="ride_distance" class="form-control @error('ride_distance') is-invalid @enderror"/>
                        @error('ride_distance')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mt-2">
                        <button class="btn btn-primary btn-sm">{{__('Ajouter')}}</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
