@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

               <h2>Liste des villes</h2>

                <a href="{{ route('cities.create') }}" class="btn btn-link">Ajouter</a>
                <table class="table table-responsive mt-5">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>latitude</th>
                        <th>longitude</th>
                        <th>Moyen livr.</th>
                        <th>Prix / km</th>
                        <th>Prix fixe</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($cities as $city)
                            <tr>
                                <td> {{ $city->id }} </td>
                                <td> {{ $city->name }} </td>
                                <td> {{ $city->latitude }} </td>
                                <td> {{ $city->longitude }} </td>
                                <td> {{ $city->delivery_charge_method }} </td>
                                <td> {{ $city->per_km_charge }} </td>
                                <td> {{ $city->fixed_charge }} </td>
                                <td> <button class="btn btn-sm btn-danger"></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
