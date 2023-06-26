@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h2>Nouveau paramètre</h2>

                <form action="{{ route('settings.store') }}" method="post" enctype="multipart/form-data">
                    @csrf


                    <div class="form-group">
                        <label for="variable">Variable</label>
                        <input type="text" name="variable" id="variable" class="form-control">
                        @error('variable')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="value">Valeur</label>
                        <textarea name="value" id="value" class="form-control"></textarea>
                        @error('value')
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
