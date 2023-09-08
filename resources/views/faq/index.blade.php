@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="row flex-grow">
            <div class="col-md-8 col-lg-8 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <h4 class="card-title">FAQ</h4>

                        <div class="d-sm-flex justify-content-between align-items-start">
                            <div></div>
                            <a href="{{ route('faqs.create') }}" class="btn btn-primary text-white mb-0 me-0">Ajouter</a>

                        </div>
                        <div class="table-responsive">
                            <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>question</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($faqs as $faq)
                                <tr>
                                    <td> {{ $faq->id }} </td>
                                    <td> {{ $faq->question }} </td>
                                    <td> <a href="{{ route("faqs.edit", $faq) }}" class="btn btn-sm btn-primary"></a>
                                        <a onclick="document.getElementById('deleteform').submit()" class="btn btn-sm btn-danger" style="margin-left: 5px;"></a>
                                        <form id="deleteform" method="post" action="{{ route("faqs.destroy", $faq->id) }}">
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
                        <form action="{{ route("faqs.store") }}" method="post" enctype="multipart/form-data">
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
                                <input type="text" name="question" placeholder="Question" class="form-control form-control-lg" />
                            </div>
                            <div class="form-group">
                                <textarea name="response" class="form-control form-control-lg"></textarea>
                            </div>


                            <button class="btn btn-primary">Valider</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
