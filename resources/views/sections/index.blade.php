@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="row flex-grow">
            <div class="col-md-8 col-lg-8 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <h4 class="card-title">{{ __("Sections") }}</h4>

                        <div class="d-sm-flex justify-content-between align-items-start">
                            <div></div>
                            <a href="{{ route('sections.create') }}"
                               class="btn btn-primary text-white mb-0 me-0">{{__("Ajouter")}}</a>

                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Box</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sections as $section)
                                    <tr>
                                        <td> {{ $section->id }} </td>
                                        <td> {{ $section->title }} </td>
                                        <td>
                                            <ul>
                                                @foreach($section->Boxes as $box)
                                                    <li>{{ $box->Box->name ?? "" }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td><a href="{{ route("sections.edit", $section) }}"
                                               class="btn btn-sm btn-primary"></a>
                                            <a onclick="document.getElementById('deleteform').submit()" class="btn btn-sm btn-danger" style="margin-left: 5px;"></a>
                                            <form id="deleteform" method="post" action="{{ route("sections.destroy", $section->id) }}">
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
                        <form action="{{ route("sections.store") }}" method="post">
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
                                <input type="text" name="title" class="form-control form-control-lg"
                                       placeholder="Titre"/>
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
