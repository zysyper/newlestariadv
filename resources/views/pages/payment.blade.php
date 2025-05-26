@extends('layouts.app')
@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 py-8 px-4">
    <div class="max-w-md mx-auto">
        <!-- Main Payment Card -->
        <div class="bg-white shadow-xl rounded-3xl p-8 space-y-8 border border-gray-100 backdrop-blur-sm">
            <!-- Header Section -->
            <div class="text-center space-y-3">
                <div class="w-16 h-16 mx-auto bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h4"></path>
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-gray-800">Pembayaran QRIS</h2>
                <p class="text-gray-600">Scan QR code di bawah ini untuk melanjutkan pembayaran</p>
            </div>

            <!-- QR Code Section -->
            <div class="relative">
                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-1 rounded-2xl">
                    <div class="bg-white rounded-xl p-6 flex justify-center">
                        <div class="relative">
                            <!-- QR Code placeholder with animation -->
                            <div class="w-64 h-64 bg-gray-100 rounded-xl border-2 border-dashed border-gray-300 flex items-center justify-center relative overflow-hidden">
                                <!-- Replace this div with actual QR code -->
                                <img src="{{ asset('qris.png') }}" alt="QRIS" class="w-full h-full object-cover rounded-lg">

                                <!-- Scanning animation overlay -->
                                <div class="absolute inset-0 pointer-events-none">
                                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-blue-500 to-transparent animate-pulse"></div>
                                </div>
                            </div>

                            <!-- Corner decorations -->
                            <div class="absolute -top-2 -left-2 w-6 h-6 border-l-4 border-t-4 border-blue-500 rounded-tl-lg"></div>
                            <div class="absolute -top-2 -right-2 w-6 h-6 border-r-4 border-t-4 border-blue-500 rounded-tr-lg"></div>
                            <div class="absolute -bottom-2 -left-2 w-6 h-6 border-l-4 border-b-4 border-blue-500 rounded-bl-lg"></div>
                            <div class="absolute -bottom-2 -right-2 w-6 h-6 border-r-4 border-b-4 border-blue-500 rounded-br-lg"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Amount Section -->
            <div class="text-center space-y-2 bg-gray-50 rounded-2xl p-6">
                <p class="text-sm text-gray-500 font-medium">Nominal Pembayaran</p>
                <p class="text-3xl font-bold text-green-600">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</p>
                <div class="flex items-center justify-center space-x-2 text-sm text-gray-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Kirim Bukti Pembayaran ke Nomor Whatsapp ini</span>
                </div>
                <a class="mt-6 font-bold text-center text-blue-600 text-1xl" href="https://wa.me/085810200320" target="_blank">085810200320</a>
            </div>




            <!-- Instructions -->
            <div class="bg-blue-50 rounded-2xl p-4 space-y-3">
                <h4 class="font-semibold text-blue-900 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Cara Pembayaran
                </h4>
                <ol class="text-sm text-blue-800 space-y-2">
                    <li class="flex items-start">
                        <span class="bg-blue-200 text-blue-800 rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold mr-3 mt-0.5">1</span>
                        Buka aplikasi mobile banking atau e-wallet
                    </li>
                    <li class="flex items-start">
                        <span class="bg-blue-200 text-blue-800 rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold mr-3 mt-0.5">2</span>
                        Pilih menu "Scan QR" atau "QRIS"
                    </li>
                    <li class="flex items-start">
                        <span class="bg-blue-200 text-blue-800 rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold mr-3 mt-0.5">3</span>
                        Scan QR code yang tersedia
                    </li>
                    <li class="flex items-start">
                        <span class="bg-blue-200 text-blue-800 rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold mr-3 mt-0.5">4</span>
                        Konfirmasi pembayaran di aplikasi
                    </li>
                </ol>
            </div>

            <!-- Action Button -->
            <div class="space-y-4">
                <a href="https://wa.me/085810200320" class="w-full px-6 py-3 bg-blue-500 text-white font-medium rounded-2xl hover:bg-blue-200 transition-colors duration-200 text-center block">
                    Kirim Bukti Pembayaran
                </a>

                <button type="button"
                    data-hs-overlay="#payment-status"
                    class="w-full px-6 py-4 bg-gradient-to-r from-green-500 to-green-600 text-white font-semibold rounded-2xl hover:from-green-600 hover:to-green-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="5 13l4 4L19 7"></path>
                    </svg>
                    <span>Saya Sudah Bayar</span>
                </button>

                <a href="{{ route('my-orders') }}" class="w-full px-6 py-3 bg-gray-100 text-gray-700 font-medium rounded-2xl hover:bg-gray-200 transition-colors duration-200 text-center block">
                    Kembali
                </a>

            </div>

            <!-- Timer Section -->
            <div class="text-center bg-yellow-50 rounded-2xl p-4">
                <p class="text-sm text-yellow-800 font-medium">Selesaikan pembayaran dalam</p>
                <div class="text-2xl font-bold text-yellow-600 mt-1" id="countdown">24 Jam</div>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Modal -->
<div id="payment-status" class="hs-overlay hidden fixed inset-0 z-[80] overflow-y-auto bg-black/50 backdrop-blur-sm">
    <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 hs-overlay-open:scale-100
                hs-overlay-close:mt-0 hs-overlay-close:opacity-0 hs-overlay-close:scale-95 transition-all
                ease-in-out w-full max-w-md mx-auto mt-20 px-4">
        <div class="bg-white rounded-3xl shadow-2xl p-8 text-center space-y-6 border border-gray-100">
            <!-- Loading Animation -->
            <div class="w-20 h-20 mx-auto">
                <div class="relative">
                    <div class="w-20 h-20 border-4 border-blue-200 rounded-full"></div>
                    <div class="w-20 h-20 border-4 border-blue-600 rounded-full border-t-transparent animate-spin absolute top-0 left-0"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="space-y-2">
                <h3 class="text-2xl font-bold text-gray-800">Memverifikasi Pembayaran</h3>
                <p class="text-gray-600">Mohon tunggu sebentar, kami sedang memverifikasi pembayaran Anda...</p>
            </div>

            <div class="flex space-x-3">
                <button type="button"
                    class="flex-1 px-6 py-3 bg-gray-100 text-gray-700 font-medium rounded-2xl hover:bg-gray-200 transition-colors duration-200"
                    data-hs-overlay="#payment-status">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>



@endsection
