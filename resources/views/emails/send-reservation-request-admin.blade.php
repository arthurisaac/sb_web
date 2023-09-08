@component('mail::message')
    <p>Une nouvelle réservation a été enregistrée.</p>
    <br>
    <p><b>Cadeau</b> : {{ $box->name }}</p>
    <p><b>Date réservée</b> : {{ $reservation }}</p>
    <br>
    <p><b>Client</b> : {{ $user->nom }} {{ $user->prenom }}</p>
    <p><b>Contact</b> : {{ $user->mobile }}</p>
    <p><b>Mail</b> : {{ $user->email }}</p>
@endcomponent
