@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="row flex-grow">
            <div class="col-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <h4 class="card-title">Nouvelle</h4>
                        <div class="card-description">
                            <a class="text-warning" href="{{ route("sliders-main-page.index") }}">Retour</a>
                        </div>
                        <br>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div><br/>
                        @endif
                        @if(session()->get('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                            <br>
                        @endif

                        <form action="{{ route("sliders-main-page.store") }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <select name="type" class="form-control form-control-lg">
                                    <option>aucun</option>
                                    <option>categorie</option>
                                    <option>produit</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select type="number" name="type_id" class="form-control form-control-lg">
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="file" name="image" class="form-control form-control-lg" placeholder="Image" />
                            </div>

                            <button class="btn btn-primary">Valider</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
