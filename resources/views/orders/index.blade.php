@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="row flex-grow">
            <div class="col-md-10 col-lg-10 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <h4 class="card-title">Commandes en cours</h4>

                        <div class="d-sm-flex justify-content-between align-items-start">
                            <div></div>
                            {{--<a href="{{ route('boxes.create') }}" class="btn btn-primary text-white mb-0 me-0">Ajouter</a>--}}

                        </div>
                        <div class="table-responsive">
                            <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Utilisateur</th>
                                <th>Box</th>
                                <th>Prix</th>
                                <th>Type de livraison</th>
                                <th>Livraison</th>
                                <th>Code</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pendingOrders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->User->nom ?? "" }} {{ $order->User->prenom ?? "" }}</td>
                                    <td><a target="_blank" href="{{ route("boxes.edit", $order->box) }}">{{ $order->Box->name ?? "Box introuvable" }}</a></td>
                                    <td>{{ $order->total }}</td>
                                    <td>{{ $order->delivery }}</td>
                                    <td>{{ $order->delivery_place }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>{{ $order->trique }}</td>
                                    <td> <a href="{{ route("orders.edit", $order->id) }}" class="btn btn-sm btn-primary">Modifier</a>
                                        <a onclick="if(confirm('Supprimer ?')){document.getElementById('deleteform').submit()}" class="btn btn-sm btn-danger" style="margin-left: 5px;">Supprimer</a>
                                        <form id="deleteform" method="post" action="{{ route("orders.destroy", $order->id) }}">
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
            <div class="col-md-2 col-lg-2 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                    </div>
                </div>
            </div>
        </div>
        <div class="row flex-grow">
            <div class="col-md-10 col-lg-10 grid-margin stretch-card">
                <div class="card card-rounded mt-5">
                    <div class="card-body">
                        <h4 class="card-title">Commandes</h4>

                        <div class="d-sm-flex justify-content-between align-items-start">
                            <div></div>
                            {{--<a href="{{ route('boxes.create') }}" class="btn btn-primary text-white mb-0 me-0">Ajouter</a>--}}

                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Utilisateur</th>
                                    <th>Box</th>
                                    <th>Prix</th>
                                    <th>Type de livraison</th>
                                    <th>Livraison</th>
                                    <th>Code</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($allOrders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->User->nom ?? "" }} {{ $order->User->prenom ?? "" }}</td>
                                        <td><a target="_blank" href="{{ route("boxes.edit", $order->box) }}">{{ $order->Box->name ?? "Box introuvable" }}</a></td>
                                        <td>{{ $order->total }}</td>
                                        <td>{{ $order->delivery }}</td>
                                        <td>{{ $order->delivery_place }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->trique }}</td>
                                        <td> <a href="{{ route("orders.edit", $order->id) }}" class="btn btn-sm btn-primary"></a>
                                            <a onclick="if(confirm('Supprimer ?')){document.getElementById('deleteform').submit()}" class="btn btn-sm btn-danger" style="margin-left: 5px;"></a>
                                            <form id="deleteform" method="post" action="{{ route("orders.destroy", $order->id) }}">
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
        </div>
    </div>
@endsection
