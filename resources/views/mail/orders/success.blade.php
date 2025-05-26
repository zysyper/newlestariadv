<x-mail::message>
# Order Sukses

Terimakasih telah Order Produk Kami : {{ $order->notes }}

<x-mail::button :url="$url">
View Order
</x-mail::button>

Terimakasih,<br>
{{ config('app.name') }}
</x-mail::message>
