<x-mail::message>
# Introduction
Hai {{ $booking->name }}, terima kasih telah memesan tiket di buyTickets, kami sedang memeriksa pembayaraan anda saat ini. 
Anda dapat memeriksa secara berkala pada website kami dan berikut adalah booking transsaksi ID anda: {{ $booking->booking_trx_id }}

{{--  The body of your message.  --}}

<x-mail::button :url="route('front.check_booking')">
{{--  Button Text  --}}
Check Booking
</x-mail::button>

{{--  Thanks,<br>  --}}
Terima kasih, <br>
{{ config('app.name') }}
</x-mail::message>
