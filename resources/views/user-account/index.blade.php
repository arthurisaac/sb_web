@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="row flex-grow">
            <div class="col-md-8 col-lg-8 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <h4 class="card-title">Gestion des comptes utilisateurs</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Téléphone</th>
                                    <th>Solde</th>
                                    <th>Sous-compte</th>
                                    <th>Montant Sous-compte</th>
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
                                        <td> {{ $user->account }} F CFA </td>
                                        <td> {{ count($user->SubAccounts) }} </td>
                                        <td> {{ $user->SubAccounts->sum("solde") ?? 0 }} </td>
                                        <td>
                                            <a href="{{ route("users-accounts.show", $user) }}" class="btn btn-sm btn-primary"></a>
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
                        <h4 class="card-title card-title-dash">Statistiques</h4>
                        <br>
                        <h4>Total solde : <b>{{ $users->sum('account') }}</b></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
