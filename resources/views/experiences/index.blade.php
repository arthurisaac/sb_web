@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="row flex-grow">
            <div class="col-md-12 col-lg-10 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <h4 class="card-title">{{__('Expériences')}}</h4>

                        <div class="d-sm-flex justify-content-between align-items-start">
                            <div></div>
                            <a href="{{ route('experiences.create') }}" class="btn btn-primary text-white mb-0 me-0">Ajouter</a>

                        </div>
                        <div class="table-responsive">
                            <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Pays</th>
                                <th>Ville</th>
                                <th>Adresse</th>
                                <th>Coordonées</th>
                                <th>Illustration</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($experiences as $experience)
                                <tr>
                                    <td> {{ $experience->id }} </td>
                                    <td> {{ $experience->countre }} </td>
                                    <td> {{ $experience->city }} </td>
                                    <td> {{ $experience->address }} </td>
                                    <td> {{ $experience->latitude }}, {{ $experience->longitude }},  </td>
                                    <td><img src="{{ url("storage/" . $experience->image) }}" alt="">  </td>
                                    <td> <a href="{{ route("experiences.edit", $experience) }}" class="btn btn-sm btn-primary"></a><a href="{{ route("experiences.destroy", $experience->id) }}" class="btn btn-sm btn-danger" style="margin-left: 5px;"></a></td>
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
