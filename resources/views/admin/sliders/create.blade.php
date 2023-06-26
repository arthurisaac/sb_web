@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h2>{{__("Nouveau slider")}}</h2>

                <form action="{{ route('sliders.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="type">Type</label>
                        <select name="type" id="type" class="form-control  @error('type') is-invalid @enderror" required>
                            <option>Aucun</option>
                            <option>Catégorie</option>
                            <option>Produit</option>
                        </select>
                        @error('type')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="type_id">Type ID</label>
                        <input type="number" name="type_id" id="type_id" class="form-control">
                        @error('type_id')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image"
                               class="form-control @error('image') is-invalid @enderror">
                        @error('image')
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
