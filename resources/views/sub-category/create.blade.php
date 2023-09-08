@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="row flex-grow">
            <div class="col-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <h4 class="card-title">Nouvelle</h4>
                        <div class="card-description">
                            <a class="text-warning" href="{{ route("sub-categories.index") }}">Retour</a>
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

                        <form action="{{ route("sub-categories-item.store") }}" method="post">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
