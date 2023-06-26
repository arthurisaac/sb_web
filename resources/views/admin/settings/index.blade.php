@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

               <h2>Liste des paramètres</h2>

                <a href="{{ route('settings.create') }}" class="btn btn-link">Ajouter</a>
                <table class="table table-responsive mt-5">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Variable</th>
                        <th>Valeur</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($settings as $setting)
                            <tr>
                                <td> {{ $setting->id }} </td>
                                <td> {{ $setting->variable }} </td>
                                <td> {{ $setting->value }} </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
