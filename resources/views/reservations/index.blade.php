@extends('layouts.app')

@section('content')

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
        <div class="row flex-grow">
            <div class="col-md-12 col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <h4 class="card-title">Reservations</h4>

                        <div class="d-sm-flex justify-content-between align-items-start">
                            <div></div>
                            {{--<a href="{{ route('sliders-main-page.create') }}"
                               class="btn btn-primary text-white mb-0 me-0">Ajouter</a>--}}

                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order</th>
                                    <th>Box</th>
                                    <th>Client</th>
                                    <th>Téléphone</th>
                                    <th>Date réservation</th>
                                    <th>Status</th>
                                    <th>Confirmer</th>
                                    <th>Réfuser</th>
                                    <th>Consommer</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($reservations as $reservation)
                                    <tr>
                                        <td> {{ $reservation->id }} </td>
                                        <td><a href="orders/{{$reservation->id}}" target="_blank">Commande
                                                N°{{ $reservation->id }}</a></td>
                                        <td><a href="boxes/{{$reservation->box}}"
                                               target="_blank">{{ $reservation->Box->name }}</a></td>
                                        <td> {{ $reservation->User->nom ?? "-" }} {{ $reservation->User->prenom ?? "-" }} </td>
                                        <td> {{ $reservation->User->mobile ?? "-" }}</td>
                                        <td> {{ date("d-m-Y", strtotime($reservation->reservation)) }} </td>
                                        <td>
                                            @if ($reservation->status == 0 )
                                                <p class="text-warning">En attente</p>
                                            @elseif($reservation->status == 1)
                                                <p class="text-primary">Confirmé</p>
                                            @elseif($reservation->status == 2)
                                                <p class="text-success">Consommé</p>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($reservation->status == 0 )
                                                <a onclick="document.getElementById('acceptform').submit()"
                                                   class="btn btn-sm btn-primary" style="margin-left: 5px;">Accepter</a>
                                                <form id="acceptform" method="post"
                                                      action="{{ route("reservation-confirmation") }}">
                                                    @csrf

                                                    <input type="hidden" name="order"
                                                           value="{{ $reservation->id }}">
                                                </form>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($reservation->status == 0 )
                                                <a onclick="document.getElementById('deleteform').submit()"
                                                   class="btn btn-sm btn-danger" style="margin-left: 5px;">Rejeter</a>
                                                <form id="deleteform" method="post"
                                                      action="{{ route("reservation-reject") }}">
                                                    @csrf

                                                    <input type="hidden" name="order"
                                                           value="{{ $reservation->id }}">
                                                </form>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($reservation->status == 1 )
                                                <a onclick="document.getElementById('consumeform').submit()"
                                                   class="btn btn-sm btn-warning" style="margin-left: 5px;"></a>
                                                <form id="consumeform" method="post"
                                                      action="{{ route("reservation-consume") }}">
                                                    @csrf

                                                    <input type="hidden" name="order"
                                                           value="{{ $reservation->id }}">
                                                </form>
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
