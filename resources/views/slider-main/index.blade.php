@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="row flex-grow">
            <div class="col-md-8 col-lg-8 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <h4 class="card-title">Slider page principale</h4>

                        <div class="d-sm-flex justify-content-between align-items-start">
                            <div></div>
                            {{--<a href="{{ route('sliders-main-page.create') }}"
                               class="btn btn-primary text-white mb-0 me-0">Ajouter</a>--}}

                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Type</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sliders as $slider)
                                    <tr>
                                        <td> {{ $slider->id }} </td>
                                        <td> <img src="{{ url("storage/" . $slider->image) }}" alt=""> </td>
                                        <td> {{ $slider->type }} </td>
                                        <td><a href="{{ route("sliders-main-page.edit", $slider) }}"
                                               class="btn btn-sm btn-primary">Ajouter</a>
                                            <a onclick="document.getElementById('deleteform').submit()"
                                               class="btn btn-sm btn-danger" style="margin-left: 5px;">Modifier</a>
                                            <form id="deleteform" method="post"
                                                  action="{{ route("sliders-main-page.destroy", $slider->id) }}">
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
                        <h4 class="card-title card-title-dash">Ajouter</h4>
                        <br>
                        <form action="{{ route("sliders-main-page.store") }}" method="post"
                              enctype="multipart/form-data">
                            @csrf

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

                            <div class="form-group">
                                <select name="type" class="form-control form-control-lg">
                                    <option>aucun</option>
                                    <option>categorie</option>
                                    <option>produit</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select type="number" name="type_id" class="form-control form-control-lg">
                                    <option></option>
                                    @foreach($categories as $categorie)
                                        <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="file" name="image" class="form-control form-control-lg"
                                       placeholder="Image"/>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary">Valider</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
