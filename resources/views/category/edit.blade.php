@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h2>Nouvelle catégorie</h2>

                <br>
                <br>
                <form action="{{ route("categories.store") }}" method="post">
                    @csrf

                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Nom" />
                    </div>

                    <br>
                    <div class="form-group">
                        <textarea name="description" class="form-control"></textarea>
                    </div>

                    <br>
                    <button class="btn btn-primary">Valider</button>
                </form>

            </div>
        </div>
    </div>
@endsection
