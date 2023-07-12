@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="row flex-grow">
            <div class="col-md-8 col-lg-8 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <h4 class="card-title">Catégories</h4>

                        <div class="d-sm-flex justify-content-between align-items-start">
                            <div></div>
                            <a href="{{ route('categories.create') }}" class="btn btn-primary text-white mb-0 me-0">Ajouter</a>

                        </div>
                        <div class="table-responsive">
                            <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Actif</th>
                                <th>Ordre</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td> {{ $category->id }} </td>
                                    <td> {{ $category->name }} </td>
                                    <td> {{ ($category->isActive == 0) ? "Actif" : "Inactif" }} </td>
                                    <td> {{ $category->order }} </td>
                                    <td> <a href="{{ route("categories.edit", $category) }}" class="btn btn-sm btn-primary"></a><button class="btn btn-sm btn-danger" style="margin-left: 5px;"></button></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <h4  class="card-title card-title-dash">Ajouter</h4>
                        <br>
                        <form action="{{ route("categories.store") }}" method="post">
                            @csrf

                            <div class="form-group">
                                <input type="text" name="name" class="form-control form-control-lg" placeholder="Nom" />
                            </div>
                            <div class="form-group">
                                <textarea name="description" class="form-control form-control-lg" rows="10" placeholder="Description"></textarea>
                            </div>

                            <button class="btn btn-primary">Valider</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
