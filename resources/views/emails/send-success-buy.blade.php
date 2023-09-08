@component('mail::message')
    <p>Bonjour,</p>
    <p>Merci pour votre achat.</p>
    <br>
    <p><b>Cadeau</b> : {{ $box->name }}</p>
    <p><b>Prix</b> : {{ $box->price }}</p>
    <p><b>Prix réduit</b> : {{ $box->discount ?? 0 }}</p>
    <p><b>Total</b> : {{ $orderPayment->amount ?? 0 }}</p>
    <br>

@endcomponent
