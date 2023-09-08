@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="row flex-grow">
            <div class="col-md-10 col-lg-10 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        @if ($section)
                            <h4 class="card-title">Modifier</h4>

                            <div class="card-description">
                                <a class="text-warning" href="{{ route("sections.index") }}">Retour</a>
                            </div>
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

                            <form action="{{ route("sections.update", $section) }}" method="post"
                                  enctype="multipart/form-data">
                                @method('PATCH')
                                @csrf

                                <div class="form-group">
                                    <input type="text" name="title" class="form-control form-control-lg"
                                           value="{{ $section->title }}" placeholder="Titre"/>
                                </div>
                                <select class="form-control form-control-lg" name="boxes[]" multiple>
                                    @foreach($section->Boxes as $box)
                                        <option value="{{ $box->id }}">{{ $box->name }}</option>
                                    @endforeach
                                    @foreach($boxes as $boxe)
                                        <option value="{{ $boxe->id }}">{{ $boxe->name }}</option>
                                    @endforeach
                                </select>
                                <br>

                                <button class="btn btn-primary">Valider</button>
                            </form>
                        @else

                            <h1>Section introuvable</h1>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
