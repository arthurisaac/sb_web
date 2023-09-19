@component('mail::message')
    <p>Bonjour,</p>
    <p>Votre réservation ne peut être enregistrée car cette date est déjà occupée.</p>
    <p>Veuillez choisir une autre date entre le <strong>{{ $box->start_time }}</strong> et le <strong>{{ $box->end_time }}</strong> s'il vous plait</p>
    <br>
    <p><b>Cadeau</b> : {{ $box->name }}</p>
    <br>
    <p>Merci pour votre confiance.</p>
    <br>

@endcomponent
