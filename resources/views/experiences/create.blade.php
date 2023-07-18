@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="row flex-grow">
            <div class="col-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <h4 class="card-title">Nouvelle expérience</h4>
                        <div class="card-description">
                            <a class="text-warning" href="{{ route("experiences.index") }}">Retour</a>
                        </div>
                        <br>
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

                        <form action="{{ route("experiences.store") }}" method="post"  enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <input type="text" name="country" class="form-control form-control-lg" placeholder="Pays" value="Burkina Faso" />
                            </div>
                            <div class="form-group">
                                <input type="text" name="city" class="form-control form-control-lg" placeholder="Ville" value="Ouagadougou" />
                            </div>
                            <div class="form-group">
                                <input type="text" name="latitude" class="form-control form-control-lg" placeholder="Latitude" value="0.0" />
                            </div>
                            <div class="form-group">
                                <input type="text" name="longitude" class="form-control form-control-lg" placeholder="Longitude" value="0.0" />
                            </div>
                            <div class="form-group">
                                <input type="text" name="address" class="form-control form-control-lg" placeholder="Adresse" />
                            </div>
                            <div class="form-group">
                                <input type="file" name="image" class="form-control form-control-lg" />
                            </div>
                            <div class="form-group">
                                <textarea name="description" class="form-control form-control-lg" rows="10" placeholder="Description"></textarea>
                            </div>

                            <button class="btn btn-primary">Valider</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
