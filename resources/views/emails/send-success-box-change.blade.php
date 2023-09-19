@component('mail::message')
    <p>Bonjour,</p>
    <p>Votre Cadeau a été échangé par : </p>
    <br>
    <p><b>Cadeau</b> : {{ $box->name }}</p>
    <br>
    <p>Merci pour votre confiance.</p>
    <br>
@endcomponent
