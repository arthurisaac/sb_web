@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="row flex-grow">
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <h4 class="card-title">Commande N° {{ $order->id }}</h4>
                        <div class="card-description">
                            <a class="text-warning" href="{{ route("orders.index") }}">Retour commandes</a>
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


                        <hr>
                        <h3>Utilisateur</h3>
                        <br>
                        @if($order->User)
                            <div>
                                <div class="form-group">
                                    <label for="name">Nom</label>
                                    <input type="text" id="name" name="name" class="form-control form-control-lg"
                                           placeholder="name" value="{{ $order->User->nom ?? "" }}"/>
                                </div>
                                <div class="form-group">
                                    <label for="prenom">Prenom</label>
                                    <input type="text" id="prenom" name="prenom" class="form-control form-control-lg"
                                           placeholder="name" value="{{ $order->User->prenom ?? "" }}"/>
                                </div>
                                <div class="form-group">
                                    <label for="mobile">Telephone</label>
                                    <input type="tel" id="mobile" name="mobile" class="form-control form-control-lg"
                                           placeholder="mobile" value="{{ $order->User->mobile ?? "" }}"/>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" id="email" name="email" class="form-control form-control-lg"
                                           placeholder="Email" value="{{ $order->User->email ?? "" }}"/>
                                </div>
                            </div>
                        @else
                            <div>
                                <h4>Ce utilisateur n'existe plus dans la base de données</h4>
                            </div>
                        @endif

                        <hr>
                        <h3 class="text-danger">Destinataire</h3>
                        <br>
                        <div>
                            <div class="form-group">
                                <label for="nom_client">Nom client</label>
                                <input type="text" id="nom_client" name="nom_client"
                                       class="form-control form-control-lg"
                                       placeholder="Nom client" value="{{ $order->nom_client }}"/>
                            </div>
                            <div class="form-group">
                                <label for="prenom_client">Prenom client</label>
                                <input type="text" id="prenom_client" name="prenom_client"
                                       class="form-control form-control-lg"
                                       placeholder="Prenom" value="{{ $order->prenom_client }}"/>
                            </div>
                            <div class="form-group">
                                <label for="ville_client">Ville</label>
                                <input type="text" id="ville_client" name="ville_client"
                                       class="form-control form-control-lg"
                                       placeholder="Ville" value="{{ $order->ville_client }}"/>
                            </div>
                            <div class="form-group">
                                <label for="pays_client">Pays</label>
                                <input type="text" id="pays_client" name="pays_client"
                                       class="form-control form-control-lg"
                                       placeholder="Pays_client" value="{{ $order->pays_client }}"/>
                            </div>
                            <div class="form-group">
                                <label for="telephone_client">Telephone</label>
                                <input type="tel" id="telephone_client" name="telephone_client"
                                       class="form-control form-control-lg"
                                       placeholder="telephone_client" value="{{ $order->telephone_client }}"/>
                            </div>
                            <div class="form-group">
                                <label for="mail_client">Email</label>
                                <input type="text" id="mail_client" name="mail_client"
                                       class="form-control form-control-lg"
                                       placeholder="mail_client" value="{{ $order->mail_client }}"/>
                            </div>
                        </div>
                        <hr>
                        <h3>Livraison</h3>
                        <div class="form-group">
                            <label for="delivery">Comment livré</label>
                            <input type="text" id="delivery" name="delivery"
                                   class="form-control form-control-lg"
                                   placeholder="Livraison" value="{{ $order->delivery }}"/>
                        </div>
                        <div class="form-group">
                            <label for="delivery_place">Livraison</label>
                            <input type="text" id="delivery_place" name="delivery_place"
                                   class="form-control form-control-lg"
                                   placeholder="delivery_place" value="{{ $order->delivery_place }}"/>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <h4>Montant à payer : {{ $order->total }}</h4>
                        @if($order->Box)
                            @if($order->Box->discount > 0)
                                <h4>Réduction : {{ $order->Box->discount ?? 0 }}</h4>
                            @endif
                        @endif
                        <hr>
                        @if($payment)
                            <h4>Motant payé : <strong>{{ $payment->amount }}</strong></h4>
                            <h4>
                                Moyen de paiement utilisé :
                                <strong>
                                    @if ($payment->payment_method == "om")
                                        Orange money
                                    @else
                                        Autre
                                    @endif
                                </strong>
                            </h4>
                            <h4>
                                Status du paiment:
                                @if ($payment->confirmation == 1)
                                    <span class="badge badge-success">Confirmé</span>
                                @elseif ($payment->confirmation == 0)
                                    <span class="badge badge-warning">En attente</span>
                                @else
                                    <span class="badge badge-danger">Rejeté</span>
                                @endif
                            </h4>

                            <br>
                            <br>
                            @if ($payment->confirmation == 0)
                                <div class="row">
                                    <div class="col text-center">
                                        <form action="{{ route("orders-confirmation") }}" method="post">
                                            @csrf
                                            <input type="hidden" name="confirmation" value="1">
                                            <input type="hidden" name="order" value="{{ $order->id }}">
                                            <input type="hidden" name="payment" value="{{ $payment->id }}">
                                            <button class="btn btn-primary">Confirmer le paiement</button>
                                        </form>
                                    </div>
                                    <div class="col text-center">
                                        <form action="{{ route("orders-confirmation") }}" method="post">
                                            @csrf
                                            <input type="hidden" name="order" value="{{ $order->id }}">
                                            <input type="hidden" name="payment" value="{{ $payment->id }}">
                                            <input type="hidden" name="confirmation" value="-1">
                                            <button class="btn btn-danger">Rejeter le paiement</button>
                                        </form>
                                    </div>
                                </div>
                                <br>

                            @elseif ($payment->confirmation == -1)
                                <a onclick="if(confirm('Confirmer suppression ?')){document.getElementById('deleteform').submit()}" class="btn btn-sm btn-danger">Supprimer la commande</a>
                                <form id="deleteform" method="post" action="{{ route("orders.destroy", $order->id) }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endif
                        @else
                            <p class="text-center">Aucun règlement</p>
                        @endif
                        <div style="height: 30px;"></div>
                        <h4>Code d'enregistrement <strong>{{ $order->trique }}</strong></h4>
                        <hr>
                        <h4>QR Code</h4>
                        {{ QrCode::size(200)->generate( $order->trique ) }}
                        @if($order->reservation)
                            <hr>
                            <h4>Date de réservation</h4>
                            <h4>Réservation <strong>{{ $order->reservation }}</strong></h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
