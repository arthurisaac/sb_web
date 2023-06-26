@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h1>{{ __('Nouveau coursier') }}</h1>

                <form action="{{ route('delivery-men.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="user_id">{{ __("Selectionnez l'utilisateur")}}</label>
                        <select name="user_id" id="user_id" class="form-control" required>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="commission_method">{{ __("Type de commission")}}</label>
                        <select name="commission_method" id="commission_method" class="form-control @error('commission_method') is-invalid @enderror" required>
                            <option value="by_order">Par commande</option>
                        </select>
                        @error('commission_method')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="commission">{{ __("Commission")}}</label>
                        <input type="number" name="commission" id="commission" class="form-control @error('commission') is-invalid @enderror">
                        @error('commission')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="serviceable_city">{{ __("Ville serviable")}}</label>
                        <select name="serviceable_city" id="serviceable_city" class="form-control @error('serviceable_city') is-invalid @enderror" required>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                        @error('serviceable_city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status">{{ __("Status")}}</label>
                        <input type="checkbox" name="status" id="status" class="form-check @error('status') is-invalid @enderror" value="1">
                        @error('status')
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
