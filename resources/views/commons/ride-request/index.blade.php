@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

               <h2>{{ __("Historiques des demandes")}}</h2>

                <a href="{{ route('ride-request.create') }}" class="btn btn-link">Ajouter</a>
                <table class="table table-responsive mt-5">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Livreur</th>
                        <th>Client</th>
                        <th>Départ</th>
                        <th>Destination</th>
                        <th>Prix</th>
                        <th>Distance</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($requests as $ride)
                            <tr>
                                <td> {{ $ride->id }} </td>
                                <td> {{ $ride->rider }} </td>
                                <td> {{ $ride->user }} </td>
                                <td> {{ $ride->start_latitude }} {{ $ride->start_longitude }} </td>
                                <td> {{ $ride->destination_latitude }} {{ $ride->destination_longitude }} </td>
                                <td> {{ $ride->ride_price }} </td>
                                <td> {{ $ride->ride_distance }} </td>
                                <td> <button class="btn btn-sm btn-danger"></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
