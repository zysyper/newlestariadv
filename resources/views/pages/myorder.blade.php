@extends('layouts.app')

@section('content')
<div class="w-full max-w-6xl py-4 mx-auto sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="pb-4 mb-6 border-b border-gray-200">
            <h1 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                My Orders
            </h1>
            <p class="mt-1 text-sm text-gray-500">
                Track and manage your order history
            </p>
        </div>


        @if($orders->count() > 0)
            <div class="space-y-6">
                @foreach($orders as $order)
                    <div class="overflow-hidden transition-shadow duration-200 bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md">
                        <!-- Order Header -->
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                <div class="flex items-center space-x-4">
                                    <div>
                                        <h3 class="text-lg font-medium text-gray-900">
                                            Order #{{ $order->id }}
                                        </h3>
                                        <p class="text-sm text-gray-500">
                                            Placed on {{ $order->created_at->format('M d, Y \a\t g:i A') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex flex-col mt-4 sm:mt-0 sm:flex-row sm:items-center sm:space-x-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($order->status == 'delivered')
                                            bg-green-100 text-green-800
                                        @elseif($order->status == 'processing')
                                            bg-yellow-100 text-yellow-800
                                        @elseif($order->status == 'shipped')
                                            bg-blue-100 text-blue-800
                                        @elseif($order->status == 'canceled')
                                            bg-red-100 text-red-800
                                        @else
                                            bg-gray-100 text-gray-800
                                        @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($order->payment_status == 'paid')
                                            bg-green-100 text-green-800
                                        @elseif($order->payment_status == 'pending')
                                            bg-yellow-100 text-yellow-800
                                        @else
                                            bg-red-100 text-red-800
                                        @endif">
                                        Payment {{ ucfirst($order->payment_status) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Order Details -->
                        <div class="px-6 py-4">
                            <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-3">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Payment Method</h4>
                                    <p class="mt-1 text-sm text-gray-900">{{ ucfirst($order->payment_method) }}</p>
                                </div>
                                @if($order->phone)
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Phone</h4>
                                    <p class="mt-1 text-sm text-gray-900">{{ $order->phone }}</p>
                                </div>
                                @endif
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Total Amount</h4>
                                    <p class="mt-1 text-lg font-bold text-gray-900">
                                        {{ $order->currency ?? 'IDR' }} {{ number_format($order->grand_total, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>

                            @if($order->notes || $order->catatan)
                            <div class="mb-4">
                                <h4 class="text-sm font-medium text-gray-500">Pemesan</h4>
                                <p class="mt-1 text-sm text-gray-900">{{ $order->notes}}</p>
                                <h4 class="mt-2 text-sm font-medium text-gray-500">Catatan</h4>
                                <p class="mt-1 text-sm text-gray-900">{{ $order->catatan}}</p>
                            </div>
                            @endif

                            @if($order->file_path)
                            <div class="mb-4">
                                <h4 class="text-sm font-medium text-gray-500">Attached File</h4>
                                <div class="flex items-center mt-1">
                                    <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd"></path>
                                    </svg>
                                    <a href="{{ Storage::url($order->file_path) }}" target="_blank" class="ml-2 text-sm text-blue-600 hover:text-blue-500 hover:underline">
                                        @if($order->original_name)
                                            {{ $order->original_name }}
                                        @else
                                            {{ basename($order->file_path) }}
                                        @endif
                                    </a>
                                </div>
                            </div>
                            @endif

                            <!-- Order Items -->
                            @if($order->items && $order->items->count() > 0)
                            <div>
                                <h4 class="mb-3 text-sm font-medium text-gray-500">Order Items</h4>
                                <div class="border border-gray-200 divide-y divide-gray-200 rounded-md">
                                    @foreach($order->items as $item)
                                    <div class="flex items-center justify-between p-4 transition-colors duration-150 hover:bg-gray-50">
                                        <div class="flex-1">
                                            <h5 class="text-sm font-medium text-gray-900">
                                                @if($item->produk)
                                                    {{ $item->produk->name ?? 'Product #' . $item->produk_id }}
                                                @else
                                                    Product #{{ $item->produk_id }}
                                                @endif
                                            </h5>
                                            <p class="text-sm text-gray-500">
                                                Quantity: {{ $item->quantity }} × {{ $order->currency ?? 'IDR' }} {{ number_format($item->unit_amount, 0, ',', '.') }}
                                            </p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm font-medium text-gray-900">
                                                {{ $order->currency ?? 'IDR' }} {{ number_format($item->total_amount, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Order Actions -->
                        <div class="flex justify-end px-6 py-3 space-x-3 border-t border-gray-200 bg-gray-50">
                            @if(in_array($order->status, ['pending', 'processing']) && $order->payment_status != 'paid')
                            <form action="{{ route('qris') }}" method="GET" class="inline">
                                @csrf
                                <button type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-white transition-colors duration-200 bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <svg class="-ml-0.5 mr-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                    </svg>
                                    Complete Payment
                                </button>
                            </form>
                            @endif

                            <a href="{{ route('orders.show', $order->id) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-700 transition-colors duration-200 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg class="-ml-0.5 mr-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                </svg>
                                View Details
                            </a>

                            @if($order->status == 'new')
                            <form action="{{ route('orders.cancel', $order->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to cancel this order?')">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-red-700 transition-colors duration-200 bg-white border border-red-300 rounded-md shadow-sm hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    <svg class="-ml-0.5 mr-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                    Cancel Order
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $orders->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="py-12 text-center">
                <div class="w-24 h-24 mx-auto text-gray-400">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 48 48" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M34 40h10v-4a6 6 0 00-10.712-3.714M34 40H14m20 0v-4a9.971 9.971 0 00-.712-3.714M14 40H4v-4a6 6 0 0110.712-3.714M14 40v-4a9.971 9.971 0 01.712-3.714m0 0A9.973 9.973 0 0118 32a9.973 9.973 0 013.288 3.714M32 40v-4a9.973 9.973 0 00-3.288-3.714"></path>
                    </svg>
                </div>
                <h3 class="mt-6 text-lg font-medium text-gray-900">No orders yet</h3>
                <p class="mt-2 text-sm text-gray-500">
                    You haven't placed any orders yet. Start shopping to see your orders here.
                </p>
                <div class="mt-6">
                    <a href="{{ route('produk') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors duration-200 bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                        </svg>
                        Start Shopping
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
