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
                        <form action="{{ route("boxes.update") }}" method="post"  enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <select name="category" class="form-control form-control-lg"
                                                placeholder="category">
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
                                               placeholder="discount"/>
                                    </div>
                                    <div class="form-group">
                                        <input type="discount_code" name="discount_code"
                                               class="form-control form-control-lg" placeholder="discount_code"/>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control form-control-lg" name="description" placeholder="Description" rows="10"></textarea>
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
                                        <input type="text" name="country" class="form-control form-control-lg"
                                               placeholder="country"/>
                                    </div>
                                    <div class="form-group">
                                        <textarea name="must_know" class="form-control form-control-lg"
                                                  placeholder="must_know"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <textarea name="is_inside" class="form-control form-control-lg"
                                                  placeholder="is_inside"></textarea>
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
@endsection
