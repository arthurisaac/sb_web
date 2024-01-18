@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="row flex-grow">
            <div class="col-md-8 col-lg-8 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <h4 class="card-title">Gestion des utilisateurs</h4>

                        <div class="d-sm-flex justify-content-between align-items-start">
                            <div></div>
                            <a href="{{ route('users.create') }}" class="btn btn-primary text-white mb-0 me-0">Ajouter</a>

                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Téléphone</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td> {{ $user->id }} </td>
                                        <td> {{ $user->nom }} </td>
                                        <td> {{ $user->prenom }} </td>
                                        <td> {{ $user->mobile }} </td>
                                        <td> {{ $user->email }} </td>
                                        <td>
                                            <ul>
                                                @foreach($user->roles as $role)
                                                    <li>{{ $role->name }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <a href="{{ route("users.show", $user) }}" class="btn btn-sm btn-dark"></a>
                                            {{--<a onclick="document.getElementById('deleteform').submit()" class="btn btn-sm btn-danger" style="margin-left: 5px;"></a>
                                            <form id="deleteform" method="post" action="{{ route("users.destroy", $users->id) }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>--}}
                                        </td>
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
                        <h4 class="card-title card-title-dash">Affecter un role</h4>
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
                        <form action="{{ route("categories.store") }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="user">Selection l'utilisateur</label>
                                <select name="user" id="user" class="form-control form-control-lg">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->nom }}{{ $user->prenom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="user">Role</label>
                                <select name="user" id="user" class="form-control form-control-lg">
                                    <option value="1">Admin</option>
                                    <option value="2">Client</option>
                                    <option value="3">Partenaire</option>
                                    <option value="4">Régulier</option>
                                </select>
                            </div>

                            <button class="btn btn-primary">Valider</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
