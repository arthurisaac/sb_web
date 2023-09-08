@component('mail::message')
    <h1>Bonjour,</h1>
    <p>{{$user->nom}} {{$user->prenom}} vous a envoyé un cadeau : </p>
    <h4>{{ $box->name }}</h4>
    <p> {{ $box->description }}</p>
    <p>Validité du cadeau {{ $box->validity }} mois</p>
    <br>
    <p>Rendez-vous sur l'application et enregistrez votre cadeau avec code</p>
    @component('mail::panel')
        {{ $order->trique }}
    @endcomponent
    Veuillez garder ce code en lieu sûr.
@endcomponent
