@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

               <h2>Catégories</h2>

                <a href="{{ route('categories.create') }}" class="btn btn-link">Ajouter</a>
                <table class="table table-responsive mt-5">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Actif</th>
                        <th>Ordre</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td> {{ $category->id }} </td>
                                <td> {{ $category->name }} </td>
                                <td> {{ $category->isActive }} </td>
                                <td> {{ $category->order }} </td>
                                <td> <button class="btn btn-sm btn-primary"></button><button class="btn btn-sm btn-danger" style="margin-left: 5px;"></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
