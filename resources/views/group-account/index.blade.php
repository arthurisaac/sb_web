@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="row flex-grow">
            <div class="col-md-8 col-lg-8 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <h4 class="card-title">Gestion des comptes des groupes</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Solde</th>
                                    <th>A atteindre</th>
                                    <th>A cotiser</th>
                                    <th>Nbre de membres</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($groups as $group)
                                    <tr>
                                        <td>{{ $group->id }}</td>
                                        <td>{{ $group->name }}</td>
                                        <td>{{ $group->solde }}</td>
                                        <td>{{ $group->target }}</td>
                                        <td>{{ $group->subscription }}</td>
                                        <td> {{ count($group->GroupUsers) }}</td>
                                        <td>
                                            <a href="{{ route("group-account.show", $group->id) }}" class="btn btn-sm btn-dark"></a>
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
                {{--<div class="card card-rounded">
                    <div class="card-body">
                        <h4 class="card-title card-title-dash">Ajouter un utilisateur dans un groupe</h4>
                        <br>
                        --}}{{--<form action="{{ route("group.add-member") }}" method="post" enctype="multipart/form-data">
                            @csrf


                            <div class="form-group">
                                <label for="users">Description du groupe</label>
                                <select name="users[]" id="users" class="form-control form-control-lg" multiple>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->nom }} {{ $user->prenom }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button class="btn btn-primary">Valider</button>
                        </form>--}}{{--
                    </div>
                </div>--}}
            </div>
        </div>
    </div>
@endsection
