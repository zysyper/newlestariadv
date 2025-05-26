@extends('layouts.app')

@section('content')
<div class="container px-4 py-8 mx-auto">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Detail Pesanan</h1>
                    <p class="mt-1 text-gray-600">Order ID: #{{ $order->id }}</p>
                </div>
                <div class="text-right">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                        @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                        @elseif($order->status == 'shipped') bg-purple-100 text-purple-800
                        @elseif($order->status == 'delivered') bg-green-100 text-green-800
                        @elseif($order->status == 'canceled') bg-red-100 text-red-800
                        @else bg-gray-100 text-gray-800
                        @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Order Info Card -->
        <div class="p-6 mb-6 bg-white rounded-lg shadow-md">
            <h2 class="mb-4 text-xl font-semibold text-gray-900">Informasi Pesanan</h2>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <div class="space-y-3">
                        <div>
                            <span class="text-sm font-medium text-gray-500">Tanggal Pesanan</span>
                            <p class="text-gray-900">{{ $order->created_at->format('d F Y, H:i') }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-500">Status Pembayaran</span>
                            <p class="text-gray-900">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                    @if($order->payment_status == 'paid') bg-green-100 text-green-800
                                    @elseif($order->payment_status == 'pending') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="space-y-3">
                        <div>
                            <span class="text-sm font-medium text-gray-500">Total Pembayaran</span>
                            <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-500">Metode Pembayaran</span>
                            <p class="text-gray-900">{{ $order->payment_method ?? 'Belum dipilih' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="p-6 bg-white rounded-lg shadow-md">
            <h2 class="mb-6 text-xl font-semibold text-gray-900">Item Pesanan</h2>

            <div class="space-y-4">
                @foreach($order_items as $item)
                <div class="flex items-center p-4 space-x-4 border border-gray-200 rounded-lg">
                    <!-- Product Image -->
                    <div class="flex-shrink-0">
                        @if($item->produk->images && count($item->produk->images) > 0)
                            <img src="{{ Storage::url($item->produk->images[0]) }}"
                                 alt="{{ $item->produk->name }}"
                                 class="object-cover w-16 h-16 rounded-lg">
                        @else
                            <div class="flex items-center justify-center w-16 h-16 bg-gray-200 rounded-lg">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Product Details -->
                    <div class="flex-1 min-w-0">
                        <h3 class="text-lg font-medium text-gray-900 truncate">{{ $item->produk->name }}</h3>
                        <p class="mt-1 text-sm text-gray-500">{{ $item->produk->deskripsi ?? 'Tidak ada deskripsi' }}</p>

                        <!-- Product Attributes -->
                        @if($item->produk->category)
                        <div class="mt-2">
                            <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-gray-800 bg-gray-100 rounded-full">
                                {{ $item->produk->category->name }}
                            </span>
                        </div>
                        @endif
                    </div>

                    <!-- Quantity and Price -->
                    <div class="text-right">
                        <div class="text-sm text-gray-500">Qty: {{ $item->quantity }}</div>
                        <div class="mt-1 text-sm text-gray-500">@ Rp {{ number_format($item->unit_amount, 0, ',', '.') }}</div>
                        <div class="mt-2 text-lg font-semibold text-gray-900">
                            Rp {{ number_format($item->total_amount, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Order Summary -->
            <div class="pt-6 mt-8 border-t border-gray-200">
                <div class="space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Subtotal</span>
                        <span class="text-gray-900">Rp {{ number_format($order_items->sum('total_amount'), 0, ',', '.') }}</span>
                    </div>

                    @if($order->shipping_amount > 0)
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Ongkos Kirim</span>
                        <span class="text-gray-900">Rp {{ number_format($order->shipping_amount, 0, ',', '.') }}</span>
                    </div>
                    @endif

                    @if($order->tax_amount > 0)
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Pajak</span>
                        <span class="text-gray-900">Rp {{ number_format($order->tax_amount, 0, ',', '.') }}</span>
                    </div>
                    @endif

                    <div class="flex justify-between pt-3 text-lg font-semibold border-t border-gray-200">
                        <span class="text-gray-900">Total</span>
                        <span class="text-gray-900">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col justify-center gap-4 mt-8 sm:flex-row">
            <a href="{{ route('my-orders') }}"
               class="inline-flex items-center px-6 py-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>

            @if($order->status == 'new' && $order->payment_status == 'pending')
            <form action="{{ route('orders.payment', $order->id) }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="inline-flex items-center px-6 py-3 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                    </svg>
                    Bayar Sekarang
                </button>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection
