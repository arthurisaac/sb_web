@component('mail::message')
    <h1>Nous avons bien reçu votre demande de réinitialisation du mot de passe de votre compte.</h1>
    <p>Vous pouvez utiliser le code suivant pour récupérer votre compte:</p>
    @component('mail::panel')
        {{ $code }}
    @endcomponent
    La durée autorisée du code est d'une heure à partir du moment où le message a été envoyé
@endcomponent
