@component('mail::message')
    <p>Bonjour,</p>
    <p>Merci pour votre réservation.</p>
    <br>
    <p><b>Cadeau</b> : {{ $box->name }}</p>
    <p><b>Date réservée</b> : {{ $reservation }}</p>
    <p>Vous serez prévenu une fois la réservation confirmée</p>
    <br>

@endcomponent
