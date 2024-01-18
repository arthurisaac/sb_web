@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="row flex-grow">
            <div class="col-md-8 col-lg-8 grid-margin stretch-card">
                <div class="col">
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

                    <div class="card card-rounded">
                        <div class="card-body">
                            <h4 class="card-title">Détails compte</h4>

                            <hr>
                            <h4>Sous compte</h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th></th>
                                    <th>Sous compte</th>
                                    <th>Solde</th>
                                    <th>A atteindre</th>
                                    <th>Date</th>
                                    <th>Supprimer</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->SubAccounts as $account)
                                        <tr>
                                            <td>{{ $account->id }}</td>
                                            <td><img src="{{ url("storage/" . $account->Category->image) }}" alt=""></td>
                                            <td>{{ $account->Category->name ?? "Sous catégorie introuvable" }}</td>
                                            <td>{{ $account->solde }}</td>
                                            <td>{{ $account->target }}</td>
                                            <td>{{ $account->created_at }}</td>
                                            <td>
                                                <a onclick="if(confirm('Supprimer le sous compte et reverser l\'argent côtisé ?')){document.getElementById('deleteform').submit()}" class="btn btn-sm btn-danger" style="margin-left: 5px;"></a>
                                                <form id="deleteform" method="post" action="{{ route("users-accounts.destroy", $account->id) }}">
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
                    <div class="card card-rounded mt-5">
                        <div class="card-body">
                            <h4 class="card-title">Transferts</h4>
                            <hr>

                            <h4 class="text-primary">Principale</h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Avant opération</th>
                                    <th>Montant</th>
                                    <th>Solde</th>
                                    <th>Method</th>
                                    <th>Ajouter par</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($userTransferts as $transfer)
                                    <tr>
                                        <td>{{ $transfer->id }}</td>
                                        <td>{{ $transfer->before_amount }}</td>
                                        <td>{{ $transfer->amount }}</td>
                                        <td>{{ $transfer->User->account ?? "Utilisateur introuvable" }}</td>
                                        <td>{{ $transfer->method }}</td>
                                        <td>{{ $transfer->CreatedBy->nom ?? "Utilisateur introuvable" }}</td>
                                        <td>{{ $transfer->created_by }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <hr class="mt-5">
                            <h4 class="text-warning">Sous comptes</h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Sous compte</th>
                                    <th>Montant</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($transferts as $transfer)
                                        <tr>
                                            <td>{{ $transfer->id }}</td>
                                            <td>{{ $transfer->User->nom ?? "Utilisateur introuvable" }} {{ $transfer->User->prenom ?? "" }}</td>
                                            <td>{{ $transfer->SubAccounts->Category->name ?? "Sous catégorie introuvable" }}</td>
                                            <td>{{ $transfer->amount }} F CFA</td>
                                            <td>{{ $transfer->created_at }}</td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <hr class="mt-5">
                            <h4 class="text-warning">Groupes</h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Sous compte</th>
                                    <th>Montant</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 grid-margin stretch-card">
                <div class="col">
                    <div class="card card-rounded">
                        <div class="card-body">
                            <h4 class="card-title card-title-dash">Solde</h4>
                            <br>
                            <h1>{{ $user->account }} F CFA</b></h1>
                        </div>
                    </div>
                    <div class="card card-rounded mt-5">
                        <div class="card-body">
                            <h4 class="card-title card-title-dash">Ajouter sous compte</h4>
                            <br>
                            <form action="{{ route("users-accounts.store") }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="user" value="{{ $user->id }}">
                                <div class="form-group">
                                    <label for="category">Catégorie</label>
                                    <select name="category" id="category" class="form-control form-control-lg">
                                        @foreach($categories as $categorie)
                                            <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="target">Montant à atteindre</label>
                                    <input name="target" id="target" placeholder="0" min="0" class="form-control form-control-lg" required />
                                </div>

                                <button class="btn btn-primary">Valider</button>
                            </form>
                        </div>
                    </div>
                    <div class="card card-rounded mt-5">
                        <div class="card-body">
                            <h4 class="card-title card-title-dash">Ajouter dans compte principale</h4>
                            <br>
                            <form action="{{ route("user-transfer.store") }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="user" value="{{ $user->id }}">
                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <select name="type" id="type" class="form-control form-control-lg" readonly>
                                        <option value="manual">Espèces</option>
                                        <option value="orange money">Orange Money</option>
                                        <option value="moov money">Moov money</option>
                                        <option value="Autre">Autre</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="amount">Montant</label>
                                    <input name="amount" id="amount" class="form-control form-control-lg" />
                                </div>

                                <button class="btn btn-primary">Valider</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
