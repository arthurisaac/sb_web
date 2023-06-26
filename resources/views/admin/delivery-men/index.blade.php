@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

               <h2>{{ __("Liste des coursiers")}}</h2>

                <a href="{{ route('delivery-men.create') }}" class="btn btn-link">Ajouter</a>
                <table class="table table-responsive mt-5">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>ID user</th>
                        <th>Type commission</th>
                        <th>Commission</th>
                        <th>Ville serviable</th>
                        <th>Notation</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($deliveryMan as $delivery)
                            <tr>
                                <td> {{ $delivery->id }} </td>
                                <td> {{ $delivery->user->name ?? "Utilisateur introuvable" }} </td>
                                <td> {{ $delivery->commission_method }} </td>
                                <td> {{ $delivery->commission }} </td>
                                <td> {{ $delivery->deliveryCity->name ?? "Ville introuvable" }} </td>
                                <td> {{ $delivery->rating }} </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
