@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="row flex-grow">
            <div class="col-md-8 col-lg-8 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <h4 class="card-title">Catégories</h4>

                        <div class="d-sm-flex justify-content-between align-items-start">
                            <div></div>
                            <a href="{{ route('sub-categories.create') }}" class="btn btn-primary text-white mb-0 me-0">Ajouter</a>

                        </div>
                        <div class="table-responsive">
                            <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Titre</th>
                                <th>Image</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($subCategories as $category)
                                <tr>
                                    <td> {{ $category->id }} </td>
                                    <td> {{ $category->title }} </td>
                                    <td><img src="{{  url("") . '/storage/' .$category->image }}" alt=""></td>
                                    <td>
                                        <a href="{{ route("sub-categories.edit", $category) }}" class="btn btn-sm btn-primary"></a>
                                        <a onclick="document.getElementById('deleteform').submit()" class="btn btn-sm btn-danger" style="margin-left: 5px;"></a>
                                        <form id="deleteform" method="post" action="{{ route("sub-categories.destroy", $category->id) }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <h4  class="card-title card-title-dash">Ajouter</h4>
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

                        <form action="{{ route("sub-categories.store") }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <select name="category" class="form-control form-control-lg">
                                    @foreach($categories as $categorie)
                                        <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" name="title" class="form-control form-control-lg" placeholder="Titre" />
                            </div>
                            <div class="form-group">
                                <textarea name="description" class="form-control form-control-lg" rows="10" placeholder="Description"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="file" name="image" class="form-control form-control-lg"
                                       placeholder="image"/>
                            </div>

                            <button class="btn btn-primary">Valider</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
