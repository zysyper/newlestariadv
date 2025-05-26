@extends('layouts.app')

@section('title', 'Pesanan Berhasil')

@section('content')
<div class="min-h-screen px-4 py-12 bg-gradient-to-br from-blue-50 to-green-50 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Personalized greeting -->
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl animate-fade-in-down">
                Terima Kasih, {{ $order->notes }}!
            </h1>
            <p class="mt-3 text-xl text-gray-500">
                Pesanan Anda telah berhasil diterima.
            </p>
        </div>

        <!-- Success Card -->
        <div class="overflow-hidden transition-all transform bg-white shadow-xl rounded-2xl hover:shadow-2xl">
            <!-- Success Header -->
            <div class="relative px-6 py-8 bg-gradient-to-r from-green-400 to-blue-500 sm:px-10">
                <div class="absolute inset-0 bg-pattern opacity-10"></div>
                <div class="flex items-center justify-center">
                    <div class="p-3 bg-white rounded-full shadow-lg">
                        <svg class="w-10 h-10 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
                <h2 class="mt-6 text-3xl font-bold text-center text-white">
                    Pesanan Berhasil!
                </h2>
                <p class="mt-2 text-lg text-center text-white opacity-90">
                    #{{ $order->id }}
                </p>
            </div>

            <!-- Order details card -->
            <div class="px-6 py-8 sm:px-10">
                <!-- Order Summary -->
                <div class="p-6 mb-8 border border-gray-100 bg-gray-50 rounded-xl">
                    <h3 class="flex items-center text-xl font-semibold text-gray-800">
                        <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        Ringkasan Pesanan
                    </h3>

                    <div class="mt-4 space-y-3">
                        <div class="flex items-center justify-between pb-3 border-b border-gray-200">
                            <span class="text-gray-600">Nomor Pesanan:</span>
                            <span class="font-semibold text-gray-800">{{ $order->id }}</span>
                        </div>
                        <div class="flex items-center justify-between pb-3 border-b border-gray-200">
                            <span class="text-gray-600">Tanggal Pemesanan:</span>
                            <span class="font-semibold text-gray-800">{{ $order->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        <div class="flex items-center justify-between pb-3 border-b border-gray-200">
                            <span class="text-gray-600">Total Pembayaran:</span>
                            <span class="text-lg font-bold text-gray-800">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex items-center justify-between pb-3 border-b border-gray-200">
                            <span class="text-gray-600">Status Pesanan:</span>
                            <span class="px-3 py-1 text-sm font-medium text-green-800 bg-green-100 rounded-full">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Status Pembayaran:</span>
                            <span class="px-3 py-1 rounded-full text-sm font-medium {{ $order->payment_status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="mb-8">
                    <h3 class="flex items-center mb-4 text-xl font-semibold text-gray-800">
                        <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                        Metode Pembayaran
                    </h3>

                    <div class="p-6 border border-gray-100 bg-gray-50 rounded-xl">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-gray-700">{{ strtoupper($order->payment_method) }}</p>
                                <p class="mt-1 text-sm text-gray-500">Silakan selesaikan pembayaran sebelum 24 jam</p>
                            </div>
                            <div class="flex-shrink-0">
                                @if($order->payment_method === 'qris')
                                    <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                                    </svg>
                                @elseif($order->payment_method === 'transfer')
                                    <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                                    </svg>
                                @endif
                            </div>
                        </div>

                        @if($order->payment_method === 'qris')
                            <div class="flex flex-col items-center justify-center mt-6 text-center">
                                <div class="relative">
                                    <div class="absolute inset-0 z-10 flex items-center justify-center transition-opacity duration-300 bg-white bg-opacity-75 rounded-lg opacity-0 hover:opacity-100">
                                        <span class="font-medium text-blue-600">Scan untuk Pembayaran</span>
                                    </div>
                                    <div class="p-3 transition transform bg-white border-4 border-blue-100 rounded-lg shadow-md hover:scale-105">
                                        <img src="{{ asset('qris.png') }}" alt="QRIS Payment QR Code" class="object-contain w-64 h-64">
                                    </div>
                                </div>
                                <p class="inline-block p-3 mt-4 text-sm text-gray-600 border border-yellow-100 rounded-md bg-yellow-50">
                                    <span class="font-semibold">Petunjuk:</span> Kirim bukti Pembayaran Ke Nomer Whatsapp ini
                                    <a class="mt-6 font-bold text-center text-blue-600 text-1xl" href="https://wa.me/085810200320" target="_blank">085810200320</a>
                                </p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="space-y-4">
                <a href="https://wa.me/085810200320" class="w-full px-6 py-3 bg-blue-500 text-white font-medium rounded-2xl hover:bg-blue-200 transition-colors duration-200 text-center block">
                    Kirim Bukti Pembayaran
                </a>
                </div>

                <!-- Order Items -->
                @if($order->items && $order->items->count() > 0)
                <div class="p-6 mb-8 border border-gray-100 bg-gray-50 rounded-xl">
                    <h3 class="flex items-center text-xl font-semibold text-gray-800">
                        <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        Item Pesanan
                    </h3>

                    <div class="mt-4 space-y-3">
                        @foreach($order->items as $item)
                        <div class="flex items-center justify-between pb-3 border-b border-gray-200 last:border-b-0">
                            <div class="flex-1">
                                <p class="font-medium text-gray-800">{{ $item->name }}</p>
                                <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-gray-800">Rp {{ number_format($item->unit_amount, 0, ',', '.') }}</p>
                                <p class="text-sm text-gray-500">Total: Rp {{ number_format($item->total_amount, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Next Steps -->
                <div class="p-6 mb-8 border border-blue-100 bg-blue-50 rounded-xl">
                    <h3 class="flex items-center mb-4 text-xl font-semibold text-gray-800">
                        <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                        Langkah Selanjutnya
                    </h3>

                    <div class="space-y-3">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center w-8 h-8 font-bold text-blue-600 bg-blue-200 rounded-full">1</div>
                            </div>
                            <div class="ml-4">
                                <p class="font-medium text-gray-700">Selesaikan Pembayaran</p>
                                <p class="text-sm text-gray-500">Lakukan pembayaran sebelum batas waktu 24 jam</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center w-8 h-8 font-bold text-blue-600 bg-blue-200 rounded-full">2</div>
                            </div>
                            <div class="ml-4">
                                <p class="font-medium text-gray-700">Verifikasi Pembayaran</p>
                                <p class="text-sm text-gray-500">Kami akan memverifikasi pembayaran Anda dalam 1x24 jam</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center w-8 h-8 font-bold text-blue-600 bg-blue-200 rounded-full">3</div>
                            </div>
                            <div class="ml-4">
                                <p class="font-medium text-gray-700">Pemrosesan Pesanan</p>
                                <p class="text-sm text-gray-500">Pesanan Anda akan segera diproses setelah pembayaran terverifikasi</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Customer Details -->
                <div class="p-6 mb-8 border border-gray-100 bg-gray-50 rounded-xl">
                    <h3 class="flex items-center text-xl font-semibold text-gray-800">
                        <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Informasi Pelanggan
                    </h3>

                    <div class="mt-4 space-y-3">
                        <div class="flex items-center justify-between pb-3 border-b border-gray-200">
                            <span class="text-gray-600">Nama:</span>
                            <span class="font-semibold text-gray-800">{{ $order->notes }}</span>
                        </div>
                        <div class="flex items-center justify-between pb-3 border-b border-gray-200">
                            <span class="text-gray-600">Email:</span>
                            <span class="font-semibold text-gray-800">{{ $user->email }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Telepon:</span>
                            <span class="font-semibold text-gray-800">{{ $order->phone ?: 'Tidak tersedia' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="flex flex-col justify-center gap-4 mt-8 sm:flex-row">
                    <a href="{{ route('home') ?? '/' }}" class="inline-flex items-center justify-center px-6 py-3 text-base font-medium text-white transition-colors duration-200 bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Kembali ke Beranda
                    </a>

                    <button onclick="window.print()" class="inline-flex items-center justify-center px-6 py-3 text-base font-medium text-gray-700 transition-colors duration-200 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        Cetak Bukti Pesanan
                    </button>

                    @if(Route::has('my-orders'))
                    <a href="{{ route('my-orders') }}" class="inline-flex items-center justify-center px-6 py-3 text-base font-medium text-white transition-colors duration-200 bg-green-600 border border-transparent rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        Lihat Pesanan Saya
                    </a>
                    @endif
                </div>

                <!-- Help Text -->
                <div class="mt-8 text-sm text-center text-gray-500">
                    <p>Ada pertanyaan? Hubungi layanan pelanggan kami di</p>
                    <p class="font-medium text-blue-600">bilnet18@gmail.com | +62 858 1020 0320</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
