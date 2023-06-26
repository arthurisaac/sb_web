@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

               <h2>Liste des sliders</h2>

                <a href="{{ route('sliders.create') }}" class="btn btn-link">Ajouter</a>
                <table class="table table-responsive mt-5">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>type</th>
                        <th>type ID</th>
                        <th>Image</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($sliders as $slider)
                            <tr>
                                <td> {{ $slider->id }} </td>
                                <td> {{ $slider->type }} </td>
                                <td> {{ $slider->type_id }} </td>
                                <td> {{ $slider->image }} </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
