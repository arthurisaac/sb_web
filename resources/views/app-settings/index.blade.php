@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="row flex-grow">
            <div class="col-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <h4 class="card-title">Nouvelle</h4>
                        <div class="card-description"></div>
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

                        <form action="{{ route("app-settings.update", $settings) }}" method="post"
                              enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="banner_ad">Texte bannière pub</label>
                                        <textarea name="banner_ad" id="banner_ad" class="form-control form-control-lg" rows="10"
                                                  placeholder="Bande d'annonce"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="banner_ad_detail">Détails pub</label>
                                        <textarea name="banner_ad_detail" id="banner_ad_detail"
                                                  class="form-control form-control-lg" placeholder="banner_ad_detail"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="header_background">Image accueil</label>
                                        <input type="file" name="header_background" class="form-control form-control-lg"/>
                                    </div>

                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="maintenance_mode">Activer la maintenance</label>
                                        <input type="checkbox" name="maintenance_mode" id="maintenance_mode"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="min_version">Version minimum authorisé</label>
                                        <input type="text" name="min_version" id="min_version"
                                               class="form-control form-control-lg" />
                                    </div>
                                </div>
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
