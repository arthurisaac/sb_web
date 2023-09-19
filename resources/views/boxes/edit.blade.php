@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="row flex-grow">
            <div class="col-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <h4 class="card-title">Nouvelle</h4>
                        <div class="card-description">
                            <a class="text-warning" href="{{ route("boxes.index") }}">Retour gestion des boxes</a>
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
                        <form action="{{ route("boxes.update", $box) }}" method="post" enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="category">Catégorie</label>
                                        <select name="category" id="category" class="form-control form-control-lg">
                                            <option value="{{ $box->category }}">{{ $box->category }}</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="partner">Choisir le partenaire</label>
                                        <input type="text" id="partner" name="partner" class="form-control form-control-lg"
                                               placeholder="partner" value="{{ $box->partner }}"/>
                                    </div>
                                    <div class="form-group">
                                        <img src="{{ url("storage/" . $box->image) }}" alt=""
                                             style="width: 100px; height: 100px; margin-bottom: 10px;">
                                        <input type="file" name="image" class="form-control form-control-lg"
                                               placeholder="image"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Nom de la box</label>
                                        <input type="text" id="name" name="name" class="form-control form-control-lg"
                                               placeholder="name" value="{{ $box->name }}"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Prix</label>
                                        <input type="text" min="0" id="price" name="price" class="form-control form-control-lg"
                                               placeholder="price" value="{{ $box->price }}"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="discount">{{ $box->discount }}</label>
                                        <input type="text" id="discount" name="discount" class="form-control form-control-lg"
                                               placeholder="discount" value="{{ $box->discount }}"/>
                                    </div>
                                    {{--<div class="form-group">
                                        <input type="discount_code" name="discount_code"
                                               class="form-control form-control-lg" placeholder="discount_code"
                                               value="{{ $box->discount_code }}"/>
                                    </div>--}}
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control form-control-lg tinymce-editor" name="description" id="description"
                                                  placeholder="Description" rows="10">{{ $box->description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="card-group">
                                            @foreach($box->images as $image)
                                                <div class="card">
                                                    <img src="{{ url("storage/" . $image->image) }}" alt="">
                                                </div>
                                            @endforeach
                                        </div>
                                        <input type="file" name="images[]" class="form-control form-control-lg"
                                               placeholder="image" multiple="multiple"/>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="date" name="start_time" value="{{ $box->start_time }}" class="form-control form-control-lg"
                                               placeholder="start_time">
                                    </div>
                                    <div class="form-group">
                                        <input type="date" name="end_time" value="{{ $box->end_time }}" class="form-control form-control-lg"
                                               placeholder="end_time">
                                    </div>
                                    <div class="form-group">
                                        <label for="min_person">Nombre de personnes au minimum</label>
                                        <input type="number" name="min_person" id="min_person" class="form-control form-control-lg"
                                               placeholder="min_person" value="{{ $box->min_person }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="max_person">Maximum autorisé</label>
                                        <input type="number" name="max_person" id="max_person" class="form-control form-control-lg"
                                               placeholder="max_person" value="{{ $box->max_person }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="validity">Validité</label>
                                        <input type="text" name="validity" id="validity" class="form-control form-control-lg"
                                               placeholder="validité (en mois)" value="{{ $box->validity }}"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="country">Pays</label>
                                        <input type="text" name="country" id="country" class="form-control form-control-lg"
                                               placeholder="Pays" value="{{ $box->country }}"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="must_know">A savoir</label>
                                        <textarea name="must_know" id="must_know" class="form-control form-control-lg tinymce-editor"
                                                  placeholder="A savoir">{{ $box->must_know }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="is_inside">A l'intérieur</label>
                                        <textarea name="is_inside" id="is_inside" class="form-control form-control-lg tinymce-editor"
                                                  placeholder="A l'intérieur de la box">{{ $box->is_inside }}</textarea>
                                    </div>
                                </div>
                            </div>


                            <button class="btn btn-primary">Valider</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset("vendors/tinymce/tinymce.js") }}"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: 'textarea.tinymce-editor',
            height: 300,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount', 'image'
            ],
            toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_css: '//www.tiny.cloud/css/codepen.min.css'
        });
    </script>
@endsection
