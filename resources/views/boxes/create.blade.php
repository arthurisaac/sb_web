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
                        <form action="{{ route("boxes.store") }}" method="post"  enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <select name="category" class="form-control form-control-lg"
                                                placeholder="category" required>
                                            <option></option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="partner" name="partner" class="form-control form-control-lg"
                                               placeholder="partner"/>
                                    </div>
                                    <div class="form-group">
                                        <input type="file" name="image" class="form-control form-control-lg"
                                               placeholder="image" required />
                                    </div>
                                    <div class="form-group">
                                        <input type="name" name="name" class="form-control form-control-lg"
                                               placeholder="name"/>
                                    </div>
                                    <div class="form-group">
                                        <input type="price" name="price" class="form-control form-control-lg"
                                               placeholder="price"/>
                                    </div>
                                    <div class="form-group">
                                        <input type="discount" name="discount" class="form-control form-control-lg"
                                               placeholder="discount" value="0"/>
                                    </div>
                                    <div class="form-group">
                                        <input type="discount_code" name="discount_code"
                                               class="form-control form-control-lg" placeholder="discount_code"/>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control form-control-lg tinymce-editor" name="description" placeholder="Description" rows="10"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="file" name="images[]" class="form-control form-control-lg"
                                               placeholder="image" multiple="multiple" required />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="number" name="min_person" class="form-control form-control-lg"
                                               placeholder="min_person">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" name="max_person" class="form-control form-control-lg"
                                               placeholder="max_person">
                                    </div>
                                    <div class="form-group">
                                        <input type="date" name="start_time" class="form-control form-control-lg"
                                               placeholder="start_time">
                                    </div>
                                    <div class="form-group">
                                        <input type="date" name="end_time" class="form-control form-control-lg"
                                               placeholder="end_time">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="validity" class="form-control form-control-lg"
                                               placeholder="validity"/>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="country" class="form-control form-control-lg "
                                               placeholder="country"/>
                                    </div>
                                    <div class="form-group">
                                        <textarea name="must_know" class="form-control form-control-lg tinymce-editor"
                                                  placeholder="must_know"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <textarea name="is_inside" class="form-control form-control-lg tinymce-editor"
                                                  placeholder="is_inside"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <select name="experiences[]" id="experiences" class="form-control form-control-lg" multiple>
                                            @foreach($experiences as $experience)
                                                <option value="{{ $experience->id }}">{{ $experience->city }}</option>
                                            @endforeach
                                        </select>
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
