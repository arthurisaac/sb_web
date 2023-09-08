@component('mail::message')
    <h4>Nom : {{ $name }}</h4>
    <h4>Email : {{ $mail }}</h4>
    <h4>Message :</h4>
    <p>{{ $message }}</p>
@endcomponent
