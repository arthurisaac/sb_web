@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="row flex-grow">
            <div class="col-md-10 col-lg-10 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        @if ($category)
                            <h4 class="card-title">Modifier</h4>

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

                            <form action="{{ route("categories.update", $category) }}" method="post"
                                  enctype="multipart/form-data">
                                @method('PATCH')
                                @csrf

                                <div class="form-group">
                                    <input type="text" name="name" class="form-control form-control-lg"
                                           value="{{ $category->name }}" placeholder="Nom"/>
                                </div>

                                <div class="form-group">
                                    <textarea name="description"
                                              class="form-control form-control-lg">{{ $category->description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <input type="file" name="image" class="form-control form-control-lg"
                                           placeholder="image"/>
                                </div>
                                <input type="hidden" name="old_image" class="form-control form-control-lg"
                                       value="{{ $category->image }}"/>

                                <br>
                                <button class="btn btn-primary">Valider</button>
                            </form>
                        @else

                            <h1>Catégorie introuvable</h1>

                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-lg-2 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
