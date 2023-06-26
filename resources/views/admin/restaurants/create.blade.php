@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h2>Nouveau restaurant</h2>

                <form action="{{ route('restaurants.store') }}" method="post" enctype="multipart/form-data">
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
                        <label for="name">{{ __("Nom de l'enseigne du partenaire")}}</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">{{__("Description")}}</label>
                        <textarea name="description" id="description" class="form-control  @error('description') is-invalid @enderror"></textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">{{ __("Adresse")}}</label>
                        <input name="address" id="address" class="form-control @error('address') is-invalid @enderror"/>
                        @error('address')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="commission">{{__("Commission")}}</label>
                        <input type="number" name="commission" id="commission" class="form-control @error('commission') is-invalid @enderror"/>
                        @error('commission')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone_number">{{__("N° Téléphone")}}</label>
                        <input type="number" name="phone_number" id="phone_number" class="form-control @error('phone_number') is-invalid @enderror"/>
                        @error('phone_number')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">Bannière</label>
                        <input type="file" name="banner" id="banner"
                               class="form-control @error('banner') is-invalid @enderror">
                        @error('banner')
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
