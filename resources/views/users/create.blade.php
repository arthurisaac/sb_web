@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="row flex-grow">
            <div class="col-md-8 col-lg-8 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <h4 class="card-title">Gestion des utilisateurs</h4>

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


                        <form action="{{ route("users.store") }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="nom">Nom</label>
                                <input type="text" name="nom" id="nom" class="form-control form-control-lg" required/>
                            </div>
                            <div class="form-group">
                                <label for="prenom">Prénom</label>
                                <input type="text" name="prenom" id="prenom" class="form-control form-control-lg" required/>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" class="form-control form-control-lg" required/>
                            </div>
                            <div class="form-group">
                                <label for="mobile">Téléphone</label>
                                <input type="tel" name="mobile" id="mobile" class="form-control form-control-lg" required/>
                            </div>
                            <div class="form-group">
                                <label for="country">Pays</label>
                                <input type="text" name="country" id="country" class="form-control form-control-lg" required/>
                            </div>
                            <div class="form-group">
                                <label for="type">Type utilisateur</label>
                                <select name="type" id="type" class="form-control form-control-lg">
                                    <option value="1">Admin</option>
                                    <option value="2" selected>Client</option>
                                    <option value="3">Partenaire</option>
                                    <option value="4">Régulier</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="password">Mot de passe</label>
                                <input type="password" name="password" id="password" class="form-control form-control-lg" required/>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirmer mot de passe</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-lg" required/>
                            </div>
                            <div class="form-group">
                                <label for="avatar">Avatar</label>
                                <input type="file" name="avatar" id="avatar" class="form-control form-control-lg" required/>
                            </div>

                            <button class="btn btn-primary">Valider</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <h4 class="card-title card-title-dash">Statistiques</h4>
                        <br>

                        <h6 class="text-warning">Total utilisateurs : {{ count($users) }}</h6>
                        <h6>Total clients : {{ count($users->where('type', '2')) }}</h6>
                        <h6>Total partenaires : {{ count($users->where('type', '3')) }}</h6>
                        <h6>Total admin : {{ count($users->where('type', '1')) }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
