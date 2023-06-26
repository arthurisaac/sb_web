@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h2>{{__('Nouvelle requête')}}</h2>

                <form action="{{ route('cities.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name">{{ __('Nom de la ville') }}</label>
                        <input type="text" name="name" id="name" class="form-control  @error('name') is-invalid @enderror" required />
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="latitude">{{ __('Latitude') }}</label>
                        <input type="text" name="latitude" id="latitude" class="form-control  @error('latitude') is-invalid @enderror" />
                        @error('latitude')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="longitude">{{ __('Longitude') }}</label>
                        <input type="text" name="longitude" id="longitude" class="form-control  @error('longitude') is-invalid @enderror" />
                        @error('longitude')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="delivery_charge_method">{{ __('Methode de facturation') }}</label>
                        <select name="delivery_charge_method" id="delivery_charge_method" class="form-control  @error('delivery_charge_method') is-invalid @enderror" required>
                            <option value="km">Par Km</option>
                            <option value="fixed">Fixe</option>
                        </select>
                        @error('delivery_charge_method')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="fixed_charge">{{ __('Prix fixe') }}</label>
                        <input type="number" name="fixed_charge" id="fixed_charge" class="form-control  @error('fixed_charge') is-invalid @enderror" />
                        @error('delivery_charge_method')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="per_km_charge">{{ __('Prix par km') }}</label>
                        <input type="number" name="per_km_charge" id="per_km_charge" class="form-control  @error('per_km_charge') is-invalid @enderror" />
                        @error('per_km_charge')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="max_deliverable_distance">{{ __('Distance maximale de livraison    ') }}</label>
                        <input type="number" name="max_deliverable_distance" id="max_deliverable_distance" class="form-control  @error('max_deliverable_distance') is-invalid @enderror" />
                        @error('max_deliverable_distance')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="form-group mt-2">
                        <button class="btn btn-primary btn-sm">Ajouter</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
