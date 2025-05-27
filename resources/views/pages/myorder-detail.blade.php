@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
    <div class="container px-4 py-8 mx-auto">
        <div class="max-w-6xl mx-auto">

            <!-- Breadcrumb -->
            <nav class="flex mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                            <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L9 5.414V17a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1V5.414l2.293 2.293a1 1 0 0 0 1.414-1.414Z"/>
                            </svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <a href="{{ route('my-orders') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">Pesanan Saya</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Detail Pesanan</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Header Section -->
            <div class="relative mb-8 overflow-hidden bg-white shadow-xl rounded-2xl">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600 opacity-90"></div>
                <div class="relative px-8 py-10">
                    <div class="flex flex-col items-start justify-between lg:flex-row lg:items-center">
                        <div class="mb-6 lg:mb-0">
                            <div class="flex items-center mb-3">
                                <div class="p-3 mr-4 bg-white rounded-xl bg-opacity-20 backdrop-blur-sm">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h1 class="text-4xl font-bold text-white">Detail Pesanan</h1>
                                    <p class="mt-2 text-xl text-blue-100">Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4 text-blue-100">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4h3a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2V9a2 2 0 012-2h3z"></path>
                                    </svg>
                                    {{ $order->created_at->format('d F Y, H:i') }}
                                </div>
                                @if($order->notes)
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    {{ $order->notes }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="text-left lg:text-right">
                            <div class="mb-4">
                                <span class="inline-flex items-center px-4 py-2 text-sm font-semibold rounded-full
                                    @if($order->status == 'pending') bg-yellow-100 text-yellow-800 border border-yellow-200
                                    @elseif($order->status == 'processing') bg-blue-100 text-blue-800 border border-blue-200
                                    @elseif($order->status == 'shipped') bg-purple-100 text-purple-800 border border-purple-200
                                    @elseif($order->status == 'delivered') bg-green-100 text-green-800 border border-green-200
                                    @elseif($order->status == 'canceled') bg-red-100 text-red-800 border border-red-200
                                    @else bg-gray-100 text-gray-800 border border-gray-200
                                    @endif">
                                    <span class="w-2 h-2 mr-2 rounded-full
                                        @if($order->status == 'pending') bg-yellow-400
                                        @elseif($order->status == 'processing') bg-blue-400
                                        @elseif($order->status == 'shipped') bg-purple-400
                                        @elseif($order->status == 'delivered') bg-green-400
                                        @elseif($order->status == 'canceled') bg-red-400
                                        @else bg-gray-400
                                        @endif"></span>
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                            <div class="text-3xl font-bold text-white">
                                Rp {{ number_format($order->grand_total, 0, ',', '.') }}
                            </div>
                            <div class="mt-2 text-blue-100">Total Pembayaran</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid gap-8 lg:grid-cols-3">
                <!-- Main Content -->
                <div class="space-y-8 lg:col-span-2">

                    <!-- Order Items -->
                    <div class="overflow-hidden bg-white shadow-xl rounded-2xl">
                        <div class="px-8 py-6 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-gray-100">
                            <div class="flex items-center">
                                <div class="p-2 mr-4 bg-indigo-100 rounded-lg">
                                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-2xl font-bold text-gray-900">Item Pesanan</h2>
                                    <p class="text-gray-600">{{ $order->items->count() }} item dalam pesanan ini</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-8">
                            <div class="space-y-6">
                                @foreach($order_items as $index => $item)
                                <div class="relative p-6 transition-all duration-300 border border-gray-200 rounded-xl hover:shadow-lg hover:border-indigo-300 group">
                                    <div class="absolute top-4 right-4">
                                        <span class="inline-flex items-center justify-center w-8 h-8 text-sm font-semibold text-indigo-600 bg-indigo-100 rounded-full">
                                            {{ $index + 1 }}
                                        </span>
                                    </div>

                                    <div class="flex flex-col space-y-4 md:flex-row md:space-y-0 md:space-x-6">
                                        <!-- Product Image -->
                                        <div class="flex-shrink-0">
                                            @if($item->produk->images && count($item->produk->images) > 0)
                                                <div class="relative overflow-hidden rounded-xl">
                                                    <img src="{{ Storage::url($item->produk->images[0]) }}"
                                                         alt="{{ $item->produk->name }}"
                                                         class="object-cover w-24 h-24 transition-transform duration-300 md:w-32 md:h-32 group-hover:scale-105">
                                                    <div class="absolute inset-0 transition-opacity opacity-0 bg-gradient-to-t from-black/20 to-transparent group-hover:opacity-100"></div>
                                                </div>
                                            @else
                                                <div class="flex items-center justify-center w-24 h-24 transition-colors bg-gray-200 md:w-32 md:h-32 rounded-xl group-hover:bg-gray-300">
                                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Product Details -->
                                        <div class="flex-1 min-w-0">
                                            <div class="flex flex-col justify-between h-full">
                                                <div>
                                                    <h3 class="text-xl font-bold text-gray-900 transition-colors group-hover:text-indigo-600">
                                                        {{ $item->produk->name }}
                                                    </h3>
                                                    @if($item->produk->deskripsi)
                                                    <p class="mt-2 text-gray-600 line-clamp-2">{{ $item->produk->deskripsi }}</p>
                                                    @endif

                                                    @if($item->produk->kategori)
                                                    <div class="mt-3">
                                                        <span class="inline-flex items-center px-3 py-1 text-xs font-medium text-indigo-800 bg-indigo-100 rounded-full">
                                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                                            </svg>
                                                            {{ $item->produk->kategori->name }}
                                                        </span>
                                                    </div>
                                                    @endif
                                                </div>

                                                <!-- Quantity and Price Info -->
                                                <div class="mt-4">
                                                    <div class="flex items-center justify-between">
                                                        <div class="flex items-center space-x-4 text-sm text-gray-600">
                                                            <div class="flex items-center">
                                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h4a1 1 0 011 1v2h4a1 1 0 011 1v14a1 1 0 01-1 1H5a1 1 0 01-1-1V5a1 1 0 011-1h2z"></path>
                                                                </svg>
                                                                Qty: {{ $item->quantity }}
                                                            </div>
                                                            <div class="flex items-center">
                                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                                                </svg>
                                                                @ Rp {{ number_format($item->unit_amount, 0, ',', '.') }}
                                                            </div>
                                                        </div>
                                                        <div class="text-right">
                                                            <div class="text-2xl font-bold text-gray-900">
                                                                Rp {{ number_format($item->total_amount, 0, ',', '.') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Order Timeline -->
                    <div class="overflow-hidden bg-white shadow-xl rounded-2xl">
                        <div class="px-8 py-6 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-gray-100">
                            <div class="flex items-center">
                                <div class="p-2 mr-4 bg-green-100 rounded-lg">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-2xl font-bold text-gray-900">Status Pesanan</h2>
                                    <p class="text-gray-600">Lacak progres pesanan Anda</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-8">
                            <div class="relative">
                                <!-- Timeline Line (red if canceled) -->
                                <div class="absolute left-4 top-6 bottom-6 w-0.5 @if($order->status == 'canceled') bg-red-300 @else bg-gray-200 @endif"></div>
                                <div class="space-y-6">
                                    <!-- Order Created -->
                                    <div class="relative flex items-start">
                                        <div class="z-10 flex items-center justify-center w-8 h-8 bg-green-100 border-2 border-green-500 rounded-full">
                                            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <h3 class="text-lg font-semibold text-gray-900">Pesanan Dibuat</h3>
                                            <p class="text-gray-600">{{ $order->created_at->format('d F Y, H:i') }}</p>
                                        </div>
                                    </div>

                                    @if($order->status == 'canceled')
                                    <!-- Canceled Status -->
                                    <div class="relative flex items-start">
                                        <div class="z-10 flex items-center justify-center w-8 h-8 bg-red-100 border-2 border-red-500 rounded-full shadow-lg">
                                            <!-- Stylish X Icon -->
                                            <svg class="w-4 h-4 text-red-500 transition-transform duration-200 transform hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <h3 class="text-lg font-semibold text-red-600">Pesanan Dibatalkan</h3>
                                            <p class="text-gray-600">{{ $order->updated_at->format('d F Y, H:i') }}</p>
                                            @if(isset($order->cancellation_reason))
                                            <div class="inline-block px-3 py-1 mt-2 border border-red-200 rounded-lg bg-red-50">
                                                <p class="text-sm font-medium text-red-600">Alasan: {{ $order->cancellation_reason }}</p>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    @else
                                    <!-- Normal Flow Steps -->
                                    @if($order->status != 'pending')
                                    <div class="relative flex items-start">
                                        <div class="flex items-center justify-center w-8 h-8 border-2 rounded-full z-10
                                            @if(in_array($order->status, ['processing', 'shinpped', 'delivered'])) bg-blue-100 border-blue-500 @else bg-gray-100 border-gray-300 @endif">
                                            @if(in_array($order->status, ['processing', 'shinpped', 'delivered']))
                                                <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                            @else
                                                <div class="w-2 h-2 bg-gray-400 rounded-full"></div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <h3 class="text-lg font-semibold text-gray-900">Sedang Diproses</h3>
                                            <p class="text-gray-600">Pesanan sedang disiapkan</p>
                                        </div>
                                    </div>
                                    @endif

                                    @if(in_array($order->status, ['shinpped', 'delivered']))
                                    <div class="relative flex items-start">
                                        <div class="z-10 flex items-center justify-center w-8 h-8 bg-purple-100 border-2 border-purple-500 rounded-full">
                                            <svg class="w-4 h-4 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <h3 class="text-lg font-semibold text-gray-900">Pesanan Dikirim</h3>
                                            <p class="text-gray-600">Pesanan dalam perjalanan</p>
                                        </div>
                                    </div>
                                    @endif

                                    @if($order->status == 'delivered')
                                    <div class="relative flex items-start">
                                        <div class="z-10 flex items-center justify-center w-8 h-8 bg-green-100 border-2 border-green-500 rounded-full">
                                            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <h3 class="text-lg font-semibold text-gray-900">Pesanan Selesai</h3>
                                            <p class="text-gray-600">Pesanan telah diterima</p>
                                        </div>
                                    </div>
                                    @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-8">
                    <!-- Customer Info -->
                    @if($order->notes)
                    <div class="overflow-hidden bg-white shadow-xl rounded-2xl">
                        <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-indigo-50">
                            <h3 class="flex items-center text-lg font-semibold text-gray-900">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Informasi Pembeli
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center p-4 bg-blue-50 rounded-xl">
                                <div class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-blue-600">Nama Pembeli</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ $order->notes }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center p-4 bg-blue-50 rounded-xl">
                                <div class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 4H8a4 4 0 00-4 4v8a4 4 0 004 4h8a4 4 0 004-4V8a4 4 0 00-4-4z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M22 6l-10 7L2 6" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-blue-600">Email Pembeli</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ $user->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Order Info -->
                    <div class="overflow-hidden bg-white shadow-xl rounded-2xl">
                        <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-gray-100">
                            <h3 class="flex items-center text-lg font-semibold text-gray-900">
                                <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Informasi Pesanan
                            </h3>
                        </div>
                        <div class="p-6 space-y-6">
                            <div class="flex items-center justify-between p-4 rounded-xl bg-gray-50">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Status Pembayaran</p>
                                    <span class="inline-flex items-center px-3 py-1 mt-1 text-xs font-medium rounded-full
                                        @if($order->payment_status == 'paid') bg-green-100 text-green-800 border border-green-200
                                        @elseif($order->payment_status == 'pending') bg-yellow-100 text-yellow-800 border border-yellow-200
                                        @else bg-red-100 text-red-800 border border-red-200
                                        @endif">
                                        <span class="w-2 h-2 mr-2 rounded-full
                                            @if($order->payment_status == 'paid') bg-green-400
                                            @elseif($order->payment_status == 'pending') bg-yellow-400
                                            @else bg-red-400
                                            @endif"></span>
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-4 rounded-xl bg-gray-50">
                                <p class="text-sm font-medium text-gray-500">Metode Pembayaran</p>
                                <p class="mt-1 text-lg font-semibold text-gray-900">
                                    {{ $order->payment_method ?? 'Belum dipilih' }}
                                </p>
                            </div>

                            @if($order->phone)
                            <div class="p-4 rounded-xl bg-gray-50">
                                <p class="text-sm font-medium text-gray-500">Nomor Telepon</p>
                                <p class="mt-1 text-lg font-semibold text-gray-900">{{ $order->phone }}</p>
                            </div>
                            @endif

                            @if($order->original_name)
                            <div class="p-4 rounded-xl bg-gray-50">
                                <p class="text-sm font-medium text-gray-500">Nama File</p>
                                <a class="mt-1 text-blue-900" href="{{ Storage::url($order->file_path) }}">{{ $order->original_name }}</a>
                            </div>
                            @endif

                            @if($order->catatan)
                            <div class="p-4 rounded-xl bg-gray-50">
                                <p class="text-sm font-medium text-gray-500">Catatan</p>
                                <p class="mt-1 text-gray-900">{{ $order->catatan }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="overflow-hidden bg-white shadow-xl rounded-2xl">
                        <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-emerald-50 to-green-50">
                            <h3 class="flex items-center text-lg font-semibold text-gray-900">
                                <svg class="w-5 h-5 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                Ringkasan Pembayaran
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                    <span class="font-medium text-gray-600">Subtotal</span>
                                    <span class="font-semibold text-gray-900">Rp {{ number_format($order_items->sum('total_amount'), 0, ',', '.') }}</span>
                                </div>

                                @if($order->shipping_amount > 0)
                                <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                    <span class="font-medium text-gray-600">Ongkos Kirim</span>
                                    <span class="font-semibold text-gray-900">Rp {{ number_format($order->shipping_amount, 0, ',', '.') }}</span>
                                </div>
                                @endif

                                @if($order->tax_amount > 0)
                                <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                    <span class="font-medium text-gray-600">Pajak</span>
                                    <span class="font-semibold text-gray-900">Rp {{ number_format($order->tax_amount, 0, ',', '.') }}</span>
                                </div>
                                @endif

                                <div class="flex items-center justify-between pt-4 border-t-2 border-gray-200">
                                    <span class="text-xl font-bold text-gray-900">Total</span>
                                    <span class="text-2xl font-bold text-emerald-600">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-4">
                        @if($order->status == 'new' && $order->payment_status == 'pending')
                        <form action="{{ route('orders.payment', $order->id) }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="inline-flex items-center justify-center w-full px-6 py-4 text-base font-semibold text-white transition-all duration-200 transform border border-transparent shadow-lg bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 hover:scale-105 hover:shadow-xl">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                                Bayar Sekarang
                            </button>
                        </form>
                        @endif

                        <a href="{{ route('my-orders') }}"
                           class="inline-flex items-center justify-center w-full px-6 py-4 text-base font-semibold text-gray-700 transition-all duration-200 transform bg-white border-2 border-gray-300 shadow-md rounded-xl hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 hover:scale-105 hover:shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali ke Pesanan
                        </a>

                        <button onclick="window.print()" class="inline-flex items-center justify-center w-full px-6 py-4 text-base font-semibold text-indigo-700 transition-all duration-200 transform border-2 border-indigo-200 bg-indigo-50 rounded-xl hover:bg-indigo-100 hover:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                            </svg>
                            Cetak Invoice
                        </button>
                    </div>
                </div>
            </div>

            <!-- Additional Information Section -->
            <div class="mt-12">
                <div class="grid gap-8 md:grid-cols-2">
                    <!-- Contact Support -->
                    <div class="p-8 bg-white shadow-xl rounded-2xl">
                        <div class="flex items-center mb-6">
                            <div class="p-3 bg-blue-100 rounded-lg">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 2.25a9.75 9.75 0 109.75 9.75A9.75 9.75 0 0012 2.25z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-bold text-gray-900">Butuh Bantuan?</h3>
                                <p class="text-gray-600">Tim support siap membantu Anda</p>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center p-4 bg-blue-50 rounded-xl">
                                <svg class="w-5 h-5 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <span class="font-medium text-blue-900">support@toko.com</span>
                            </div>
                            <div class="flex items-center p-4 bg-green-50 rounded-xl">
                                <svg class="w-5 h-5 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <span class="font-medium text-green-900">+62 812-3456-7890</span>
                            </div>
                        </div>
                    </div>

                    <!-- Order Tips -->
                    <div class="p-8 bg-white shadow-xl rounded-2xl">
                        <div class="flex items-center mb-6">
                            <div class="p-3 bg-yellow-100 rounded-lg">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-bold text-gray-900">Tips & Info</h3>
                                <p class="text-gray-600">Informasi penting untuk pesanan Anda</p>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="p-3 rounded-lg bg-yellow-50">
                                <p class="text-sm text-yellow-800">💡 Simpan nomor pesanan untuk referensi</p>
                            </div>
                            <div class="p-3 rounded-lg bg-green-50">
                                <p class="text-sm text-green-800">📱 Notifikasi akan dikirim via email/SMS</p>
                            </div>
                            <div class="p-3 rounded-lg bg-blue-50">
                                <p class="text-sm text-blue-800">🚚 Estimasi pengiriman 2-5 hari kerja</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
