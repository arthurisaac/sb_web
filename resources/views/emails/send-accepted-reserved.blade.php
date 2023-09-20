@component('mail::message')
    <p>Bonjour,</p>
    <p>Votre réservation est confirmée.</p>
    <br>
    <p><b>Cadeau</b> : {{ $box->name }}</p>
    <p><b>Date réservée</b> : {{ $reservation }}</p>
    <br>
    <p>Merci pour votre confiance.</p>
    <br>

@endcomponent
