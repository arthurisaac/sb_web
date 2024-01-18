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
                            <h4 class="card-title">Transaction des Groupes</h4>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nom & prénom</th>
                                        <th>Solde</th>
                                        <th>Groupe</th>
                                        <th>Solde groupe</th>
                                        <th>Montant transfert</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($transferts as $transfert)
                                        <tr>
                                            <td>{{ $transfert->id }}</td>
                                            <td>{{ $transfert->User->nom ?? "Utilisateur introuvable" }} {{ $transfert->User->prenom ?? "" }}</td>
                                            <td>{{ $transfert->User->account ?? "-" }}</td>
                                            <td>{{ $transfert->Group->name ?? "Groupe introuvable" }}</td>
                                            <td>{{ $transfert->Group->solde ?? "-" }}</td>
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
                            <h4 class="card-title">Transférer vers un groupe</h4>

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
                                            <td>{{ $user->account }} F CFA</td>
                                            <td>
                                                <button class="btn btn-primary btn-sm" onclick="transfer({{$user}})">
                                                    Transférer
                                                </button>
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
                        </div>
                    </div>
                    <div class="card card-rounded mt-5">
                        <div class="card-body">
                            <h4 class="card-title card-title-dash">Transfert</h4>
                            <br>
                            <form action="{{ route("group-transactions.store") }}" method="post"
                                  enctype="multipart/form-data">
                                @csrf

                                <h4 id="userName"></h4>
                                <input type="hidden" name="user" id="user">
                                <div class="form-group">
                                    <label for="amount">Montant à transférer</label>
                                    <input type="number" name="amount" id="amount" min="0"
                                           class="form-control form-control-lg" required>
                                </div>
                                <div class="form-group">
                                    <label for="group">Groupe</label>
                                    <select name="group" id="group" class="form-control form-control-lg" required>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="turns">Tour disponible</label>
                                    <select name="turns" id="turns" class="form-control form-control-lg" required>
                                    </select>
                                    <small id="turnHelp" class="form-text text-muted"></small>
                                </div>
                                <div class="form-group">
                                    <label for="method">Methode de paiement</label>
                                    <select name="method" id="method" class="form-control form-control-lg" required>
                                        <option value="manual">Espèces</option>
                                        <option value="orange money">Orange Money</option>
                                        <option value="moov money">Moov money</option>
                                        <option value="Autre">Autre</option>
                                    </select>
                                    <small id="turnHelp" class="form-text text-muted"></small>
                                </div>

                                <button class="btn btn-primary">Valider</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function transfer(user) {
            const groupSelect = $("#group");
            const turnsSelect = $("#turns");
            const amountInput = $("#amount");

            $("#user").val(user.id)
            $("#userName").text(`${user.nom} ${user.prenom}`)
            $("#turnHelp").text("Selectionner le groupe")

            groupSelect.empty();
            turnsSelect.empty();
            amountInput.val("0")

            groupSelect.append(`<option></option>`)
            user.groups.forEach((group) => {
                amountInput.val(group?.group?.subscription);
                groupSelect.append(`<option value="${group.group?.id ?? "0"}">${group?.group?.name ?? 'Group inexistant ou supprimé'}</option>`)
            })

        }
    </script>
    @push('other-scripts')
        <script>
            $(document).ready(function () {
                const groupSelect = $("#group");
                const turnsSelect = $("#turns");

                const turnHelp = $("#turnHelp");
                turnHelp.text = "Récupération des tours en cours";
                groupSelect.on("change", function () {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('group-turn.free-turns') }}",
                        data: {'group': this.value, "_token": "{{ csrf_token() }}"},
                        success: (response) => {
                            turnHelp.text = "";
                            if (response.turns) {
                                turnsSelect.empty();

                                response.turns.forEach((turn) => {
                                    console.log(turn)
                                    turnsSelect.append(`<option value="${turn?.id}">${turn?.name} | ${turn?.start ?? 'Tour introuvable'}</option>`)
                                })
                            } else {
                                turnHelp.text = "Aucun tour enregistré";
                            }
                        },
                    });
                })
            })

        </script>
    @endpush
@endsection
