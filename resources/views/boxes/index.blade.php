@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="row flex-grow">
            <div class="col-md-10 col-lg-10 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <h4 class="card-title">Boxes</h4>

                        <div class="d-sm-flex justify-content-between align-items-start">
                            <div></div>
                            <a href="{{ route('boxes.create') }}" class="btn btn-primary text-white mb-0 me-0">Ajouter</a>

                        </div>
                        <div class="table-responsive">
                            <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Catégorie</th>
                                <th>Prix</th>
                                <th>Validité</th>
                                <th>Notation</th>
                                <th>Actif</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($boxes as $box)
                                <tr>
                                    <td> {{ $box->id }} </td>
                                    <td> {{ $box->name }} </td>
                                    <td> {{ $box->category }} </td>
                                    <td> {{ $box->price }} </td>
                                    <td> {{ $box->validity }} </td>
                                    <td> {{ $box->notation }} </td>
                                    <td> {{ ($box->enable == 1) ? "Actif" : "Inactif" }} </td>
                                    <td> <a href="{{ route("boxes.edit", $box) }}" class="btn btn-sm btn-primary">Modifier</a>
                                        <a onclick="if(confirm('Supprimer ?')){document.getElementById('deleteform').submit()}" class="btn btn-sm btn-danger" style="margin-left: 5px;">Suppimer</a>
                                        <form id="deleteform" method="post" action="{{ route("boxes.destroy", $box->id) }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-lg-2 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
