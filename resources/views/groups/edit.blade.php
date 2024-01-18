@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="row flex-grow">
            <div class="col-md-6 col-lg-6 grid-margin stretch-card">
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

                        <form action="{{ route("groups.update", $group) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="form-group">
                                <label for="name">Nom du groupe</label>
                                <input name="name" id="name" class="form-control form-control-lg"
                                       value="{{ $group->name }}" required/>
                            </div>
                            <div class="form-group">
                                <label for="target">Montant à cotiser</label>
                                <input name="target" id="target" class="form-control form-control-lg" type="number"
                                       min="0" value="{{ $group->target }}"/>
                            </div>
                            <div class="form-group">
                                <label for="subscription">Cotisation par membre</label>
                                <input name="subscription" id="subscription" class="form-control form-control-lg"
                                       type="number" min="0" value="{{ $group->subscription }}"/>
                            </div>
                            <div class="form-group">
                                <label for="rate">Fréquence de cotisation</label>
                                <select name="rate" id="rate" class="form-control form-control-lg"
                                        value="{{ $group->rate }}">
                                    <option value="daily">Journalier</option>
                                    <option value="weekly">Hebdomadaire</option>
                                    <option value="quarterly">Trimestriel</option>
                                    <option value="half-yearly">Semestriel</option>
                                    <option value="yearly">Annuellement</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="total_allowed">Total membre authorisé</label>
                                <input type="number" min="1" name="total_allowed" id="total_allowed"
                                       class="form-control form-control-lg" value="{{ $group->total_allowed }}"
                                       required/>
                            </div>
                            <div class="form-group">
                                <label for="description">Description du groupe</label>
                                <textarea name="description" id="description" class="form-control form-control-lg">
                                        {{ $group->description }}
                                    </textarea>
                            </div>

                            <button class="btn btn-primary">Valider</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 grid-margin stretch-card">
                <div class="col">
                    <div class="card card-rounded">
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
