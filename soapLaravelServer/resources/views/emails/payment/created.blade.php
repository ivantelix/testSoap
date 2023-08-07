<x-mail::message>
# Hemos registrado un pago.

Token de confirmacion de pago:
{{$payment->token}}


Copialo y envialo para confirmar pago, Gracias por realizarsus pagos con nosotros.<br>

{{ config('app.name') }}
</x-mail::message>
