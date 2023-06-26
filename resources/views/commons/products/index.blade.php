@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

               <h2>{{ __("Liste des produits")}}</h2>

                <a href="{{ route('products.create') }}" class="btn btn-link">Ajouter</a>
                <table class="table table-responsive mt-5">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Partenaire</th>
                        <th>Nom du produit</th>
                        <th>Prix</th>
                        <th>Stock</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td> {{ $product->id }} </td>
                                <td> {{ $product->partner->name ?? "Partenaire introuvable" }} </td>
                                <td> {{ $product->name }} </td>
                                <td> {{ $product->price }} </td>
                                <td> {{ $product->stock }} </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
