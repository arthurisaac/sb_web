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
                            <h4 class="card-title">Transaction des Comptes</h4>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nom & prénom</th>
                                        <th>Solde</th>
                                        <th>Sous compte</th>
                                        <th>Solde sous compte</th>
                                        <th>Montant</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($transferts as $transfert)
                                        <tr>
                                            <td>{{ $transfert->id }}</td>
                                            <td>{{ $transfert->User->nom ?? "Utilisateur introuvable" }} {{ $transfert->User->prenom ?? "" }}</td>
                                            <td>{{ $transfert->User->account ?? "-" }}</td>
                                            <td>{{ $transfert->SubAccount->Category->name ?? "Sous compte introuvable" }}</td>
                                            <td>{{ $transfert->SubAccount->solde ?? "-" }}</td>
                                            <td>{{ $transfert->amount }}</td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card card-rounded mt-5">
                        <div class="card-body">
                            <h4 class="card-title">Transférer d'un compte vers un sous compte</h4>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Solde</th>
                                        <th>Transférer</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->nom }}</td>
                                                <td>{{ $user->prenom }}</td>
                                                <td>{{ $user->account }}</td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm" onclick="transfer({{$user}})">Transférer</button>
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
                            <h4 class="card-title card-title-dash">Statistiques</h4>
                            <br>
                        </div>
                    </div>
                    <div class="card card-rounded mt-5">
                        <div class="card-body">
                            <form action="{{ route("account-transactions.store") }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <h4 id="userName"></h4>
                                <input type="hidden" name="user" id="user">
                                <div class="form-group">
                                    <label for="amount">Montant à transférer</label>
                                    <input type="number" name="amount" id="amount" max="" class="form-control form-control-lg">
                                </div>
                                <div class="form-group">
                                    <label for="subAccount">Sous compte</label>
                                    <select name="subAccount" id="subAccount" class="form-control form-control-lg">
                                        {{--@foreach($user->SubAccounts as $account)
                                            <option value="{{ $account->id }}">{{ $account->Category->name ?? "Catégory inexistante" }} | Solde : {{ $account->solde }} F CFA</option>
                                        @endforeach--}}
                                    </select>
                                </div>

                                <button class="btn btn-primary">Transférer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function transfer(user) {
            $("#user").val(user.id)
            $("#userName").text(`${user.nom} ${user.prenom}`)
            const subAccount = $("#subAccount");
            subAccount.empty();
            user.sub_accounts.forEach((account) => {
                console.log(account.category)
                subAccount.append(`<option value="${account.id}">${account.category.name ?? 'Catégorie inexistante'}</option>`)
            })
        }
    </script>
@endsection
