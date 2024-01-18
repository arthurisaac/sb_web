@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="row flex-grow">
            <div class="col-md-8 col-lg-8 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <h4 class="card-title">Gestion des groupes</h4>

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

                        <div class="d-sm-flex justify-content-between align-items-start">
                            <div></div>
                            <a href="{{ route('groups.create') }}" class="btn btn-primary text-white mb-0 me-0">Ajouter</a>

                        </div>
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
                                                <a href="{{ route("groups.edit", $group) }}" class="btn btn-sm btn-primary"></a>
                                                <a onclick="if (confirm('Supprimer le groupe? Toutes les transactions concernant ce groupe seront perdus. Action irréversible')) document.getElementById('deleteform-{{ $group->id }}').submit()" class="btn btn-sm btn-danger" style="margin-left: 5px;"></a>
                                                <form id="deleteform-{{ $group->id }}" method="post" action="{{ route("groups.destroy", $group->id) }}">
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
            <div class="col-md-4 col-lg-4 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <h4 class="card-title card-title-dash">Ajouter un groupe</h4>
                        <br>
                        <form action="{{ route("groups.store") }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="name">Nom du groupe</label>
                                <input name="name" id="name" class="form-control form-control-lg" required />
                            </div>
                            <div class="form-group">
                                <label for="target">Montant à cotiser</label>
                                <input name="target" id="target" class="form-control form-control-lg" type="number" min="0" />
                            </div>
                            <div class="form-group">
                                <label for="subscription">Cotisation par membre</label>
                                <input name="subscription" id="subscription" class="form-control form-control-lg" type="number" min="0" />
                            </div>
                            <div class="form-group">
                                <label for="rate">Fréquence de cotisation</label>
                                <select name="rate" id="rate" class="form-control form-control-lg">
                                    <option value="daily">Journalier</option>
                                    <option value="weekly">Hebdomadaire</option>
                                    <option value="quarterly">Trimestriel</option>
                                    <option value="half-yearly">Semestriel</option>
                                    <option value="yearly">Annuellement</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="total_allowed">Total membre authorisé</label>
                                <input type="number" min="1" name="total_allowed" id="total_allowed" class="form-control form-control-lg" required/>
                            </div>
                            <div class="form-group">
                                <label for="description">Description du groupe</label>
                                <textarea name="description" id="description" class="form-control form-control-lg">
                                </textarea>
                            </div>

                            <button class="btn btn-primary">Valider</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
