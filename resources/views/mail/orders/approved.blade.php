<x-mail::message>
# Introduction
Hai {{ $booking->name }}, pesanan anda dengan kode booking {{ $booking->booking_trx_id }} telah berhasil!,
silahkan datang kepada loket terdekat untuk menukarkan dengan tiket asli.

{{--  The body of your message.  --}}

<x-mail::button :url="route('front.check_booking')">
Contact CS
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
