@component('mail::message')
    <p>Bonjour,</p>
    <p>La date de votre réservation a bien été modifiée. Nous validons la nouvelle date de e réservation au plus vite. Vous serez notifié par mail une fois la validation terminée.</p>
    <br>
    <p><b>Cadeau</b> : {{ $box->name }}</p>
    <p><b>Date réservée</b> : {{ $reservation }}</p>
    <br>
    <p>Merci pour votre confiance.</p>
    <br>

@endcomponent
