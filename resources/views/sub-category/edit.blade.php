@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="row flex-grow">
            <div class="col-md-8 col-lg-8 grid-margin stretch-card">
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


                            <form action="{{ route("sub-categories-item.update", $category->id) }}" method="post">
                                @method('PATCH')
                                @csrf

                                <div class="form-group">
                                    <select class="form-control form-control-lg" name="sub">
                                        @foreach($subCategories as $sub)
                                            <option value="{{ $sub->id }}">{{ $sub->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control form-control-lg" name="boxes[]" multiple>
                                        @foreach($boxes as $box)
                                            <option value="{{ $box->id }}">{{ $box->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button class="btn btn-primary">Valider</button>
                            </form>

                        @else

                            <h1>Catégorie introuvable</h1>

                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <form action="{{ route("sub-categories.update", $category->id) }}" method="post"
                              enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf

                            <div class="form-group">
                                <input type="text" name="title" class="form-control form-control-lg"
                                       value="{{ $category->title }}" placeholder="Nom"/>
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
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
