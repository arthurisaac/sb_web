@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="row flex-grow">
            <div class="col-md-12 col-lg-8 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        @if ($user)
                            <h4 class="card-title">Modifier</h4>

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

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="nom">Nom</label>
                                        <input type="text" id="nom" name="nom" class="form-control form-control-lg"
                                               value="{{ $user->nom }}" placeholder="Nom"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="prenom">Prenom</label>
                                        <input type="text" id="prenom" name="prenom" class="form-control form-control-lg"
                                               value="{{ $user->prenom }}" placeholder="Prenom"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control form-control-lg"
                                               value="{{ $user->email }}" placeholder="Email"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile">Téléphone</label>
                                        <input type="tel" id="mobile" name="mobile" class="form-control form-control-lg"
                                               value="{{ $user->mobile }}" placeholder="Mobile"/>
                                    </div>
                                </div>
                            </div>
                        @else

                            <h1>Cet utilisateur est introuvable</h1>

                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-4 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <h5 class="card-title">Action</h5>
                        <br>
                        <h6>Inscrit le <strong>{{ $user->created_at }}</strong></h6>
                        <br>
                        <br>
                        <a onclick="if (confirm('Supprimer le compte?')) document.getElementById('deleteform').submit()" class="btn btn-sm btn-danger" style="margin-left: 5px;">Supprimer le compte</a>
                        <form id="deleteform" method="post" action="{{ route("users.destroy", $user->id) }}">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
