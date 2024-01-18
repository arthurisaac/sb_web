@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="row flex-grow">
            <div class="col-md-7 col-lg-7 grid-margin stretch-card">
                <div class="col">
                    <div class="card card-rounded">
                        <div class="card-body">
                            <h4 class="card-title">{{ $group->name }}</h4>

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
                        </div>
                    </div>
                    <div class="card card-rounded mt-5">
                        <div class="card-body">
                            <h4 class="card-title">Tour du groupe</h4>

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

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nom</th>
                                        <th>Date début</th>
                                        <th>Date fin</th>
                                        <th>A cotiser</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($group->GroupTurn as $turn)
                                        <tr>
                                            <td>{{ $turn->id }}</td>
                                            <td>{{ $turn->name }}</td>
                                            <td>{{ $turn->start }}</td>
                                            <td>{{ $turn->end }}</td>
                                            <td>{{ $turn->subscription }} F CFA</td>
                                            <td>
                                                <a onclick="if (confirm('Supprimer le tour? Action irréversible')) document.getElementById('deleteform-{{ $turn->id }}').submit()" class="btn btn-sm btn-danger" style="margin-left: 5px;"></a>
                                                <form id="deleteform-{{ $turn->id }}" method="post" action="{{ route("group-turn.destroy", $turn->id) }}">
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
            </div>
            <div class="col-md-4 col-lg-4 grid-margin stretch-card">
                <div class="col">
                    <div class="card card-rounded">
                        <div class="card-body">
                            <h4 class="card-title card-title-dash">Ajouter un tour</h4>
                            <br>
                            <form action="{{ route("group-turn.store") }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="group" value="{{ $group->id }}" />
                                <div class="form-group">
                                    <label for="name">Intitule du tour</label>
                                    <input name="name" id="name" class="form-control form-control-lg" multiple/>
                                </div>
                                <div class="form-group">
                                    <label for="start">Date de début</label>
                                    <input type="date" name="start" id="start" class="form-control form-control-lg" multiple/>
                                </div>
                                <div class="form-group">
                                    <label for="end">Date de fin</label>
                                    <input type="date" name="end" id="end" class="form-control form-control-lg" multiple/>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description/Remarque</label>
                                    <textarea name="description" id="description" class="form-control form-control-lg" multiple>
                                    </textarea>
                                </div>

                                <button class="btn btn-primary">Valider</button>
                            </form>
                        </div>
                    </div>
                    <div class="card card-rounded mt-5">
                        <div class="card-body">
                            <h4 class="card-title card-title-dash">Ajouter des membres</h4>
                            <br>
                            <form action="{{ route("group.add-member") }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="group" value="{{ $group->id }}" />
                                <div class="form-group">
                                    <label for="users">Description du groupe</label>
                                    <select name="users[]" id="users" class="form-control form-control-lg" multiple>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->nom }} {{ $user->prenom }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button class="btn btn-primary">Valider</button>
                            </form>
                        </div>
                    </div>
                    <div class="card card-rounded mt-5">
                        <div class="card-body">
                            <h4 class="card-title card-title-dash">Membres du groupe</h4>
                            <br>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Téléphone</th>
                                    <th>Date d'ajout</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($group->GroupUsers as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->User->nom ?? "Utilisateur introuvable" }}</td>
                                            <td>{{ $user->User->prenom ?? "" }}</td>
                                            <td>{{ $user->User->mobile ?? "" }}</td>
                                            <td> {{ $user->created_at }}</td>
                                            <td>
                                                @if ($user->User->id)
                                                    <a href="{{ route("users.show", $user->User->id) }}" target="_blank" class="btn btn-sm btn-dark"></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
