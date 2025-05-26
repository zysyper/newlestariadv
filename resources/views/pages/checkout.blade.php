@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="mx-auto max-w-6xl px-4 py-8">
    @if ($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 rounded-md p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan pada form:</h3>
                    <div class="mt-2 text-sm text-red-700">
                        <ul role="list" class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Checkout Form -->
        <div class="col-span-2 bg-white rounded-lg shadow-lg p-6">
            <form x-data="{ loading: false }" @submit="loading = true" action="{{ route('checkout.place') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="mb-6">
                    <h2 class="text-xl font-semibold border-b pb-2 mb-4 text-gray-700">Informasi Pembeli</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Depan</label>
                            <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('first_name') border-red-300 @enderror"
                                placeholder="Masukkan nama depan" required>
                            @error('first_name')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Belakang</label>
                            <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('last_name') border-red-300 @enderror"
                                placeholder="Masukkan nama belakang" required>
                            @error('last_name')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('phone') border-red-300 @enderror"
                        placeholder="Masukkan nomor telepon" required>
                    @error('phone')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6" x-data="{
                        isDropping: false,
                        fileName: '',
                        handleFileDrop(e) {
                            e.preventDefault();
                            this.isDropping = false;

                            let files = e.dataTransfer.files;
                            if (files.length > 0) {
                                document.getElementById('file-upload').files = files;
                                this.fileName = files[0].name;
                            }
                        },
                        handleFileSelect(e) {
                            if (e.target.files.length > 0) {
                                this.fileName = e.target.files[0].name;
                            }
                        }
                    }">
                    <h2 class="text-xl font-semibold border-b pb-2 mb-4 text-gray-700">Unggah File</h2>
                    <div class="mb-4">
                        <label for="file" class="block text-sm font-medium text-gray-700 mb-1">File Desain</label>
                        <div
                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 rounded-md transition-colors duration-200"
                            :class="{ 'border-indigo-400 bg-indigo-50': isDropping, 'border-gray-300 border-dashed': !isDropping }"
                            @dragover.prevent="isDropping = true"
                            @dragleave.prevent="isDropping = false"
                            @drop.prevent="handleFileDrop($event)"
                        >
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="file-upload" class="cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                        <span>Pilih file</span>
                                        <input id="file-upload" name="file" type="file" class="sr-only" @change="handleFileSelect($event)">
                                    </label>
                                    <p class="pl-1">atau drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">
                                    Maksimal ukuran 5MB
                                </p>
                                @error('file')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror

                                <template x-if="fileName">
                                    <p class="text-sm text-indigo-600 mt-2" x-text="fileName"></p>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="catatan" class="block text-sm font-medium text-gray-700 mb-1">Catatan Order</label>
                    <textarea name="catatan" id="catatan" rows="3"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Tambahkan catatan untuk pesanan Anda (opsional)">{{ old('catatan') }}</textarea>
                </div>

                <div class="mb-6">
                    <h2 class="text-xl font-semibold border-b pb-2 mb-4 text-gray-700">Metode Pembayaran</h2>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <input id="qris" name="payment_method" type="radio" value="qris" {{ old('payment_method') == 'qris' ? 'checked' : '' }}
                                class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500" required>
                            <label for="qris" class="ml-3 block text-sm font-medium text-gray-700">
                                QRIS
                            </label>
                        </div>
                        {{-- <div class="flex items-center">
                            <input id="transfer" name="payment_method" type="radio" value="transfer" {{ old('payment_method') == 'transfer' ? 'checked' : '' }}
                                class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                            <label for="transfer" class="ml-3 block text-sm font-medium text-gray-700">
                                Transfer Bank
                            </label>
                        </div> --}}
                    </div>
                    @error('payment_method')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-8">
        <button
            type="submit"
            :disabled="loading"
            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200 disabled:opacity-50"
        >
            <span x-show="!loading">Selesaikan Pesanan</span>
            <span x-show="loading">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Memproses Pesanan...
            </span>
        </button>
    </div>

            </form>
        </div>

        <!-- Order Summary -->
        <div class="col-span-1">
            <div class="bg-white rounded-lg shadow-lg p-6 sticky top-8">
                <h2 class="text-xl font-semibold border-b pb-2 mb-4 text-gray-700">Ringkasan Pesanan</h2>
                <div class="space-y-4 max-h-64 overflow-y-auto mb-6">
                    @if(count($cart_items) > 0)
                        @foreach($cart_items as $index => $item)
                            <div class="flex items-center justify-between py-3 border-b">
                                <div class="flex items-center">
                                    <div class="w-16 h-16 flex-shrink-0 bg-gray-100 rounded-md overflow-hidden">
                                        @if(isset($item['image']))
                                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-full h-full object-center object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-sm font-medium text-gray-700">{{ $item['name'] }}</h3>
                                        <p class="text-xs text-gray-500">Jumlah: {{ $item['quantity'] }}</p>
                                    </div>
                                </div>
                                <span class="text-sm font-medium text-gray-900">
                                    Rp {{ number_format($item['unit_amount'] * $item['quantity'], 0, ',', '.') }}
                                </span>
                            </div>
                        @endforeach
                    @else
                        <p class="text-gray-500 text-center py-4">Keranjang Anda kosong</p>
                    @endif
                </div>

                <div class="space-y-2 border-t pt-4">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Subtotal</span>
                        <span class="text-sm font-medium text-gray-900">Rp {{ number_format($grand_total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Pengiriman</span>
                        <span class="text-sm font-medium text-gray-900">Ditentukan kemudian</span>
                    </div>
                    <div class="flex justify-between border-t border-gray-200 pt-4 mt-4">
                        <span class="text-base font-medium text-gray-900">Total</span>
                        <span class="text-base font-bold text-indigo-600">Rp {{ number_format($grand_total, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="mt-6">
                    <div class="bg-gray-50 p-4 rounded-md">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-indigo-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-gray-700">
                                    Setelah pembayaran Anda selesai, tim kami akan segera memproses pesanan Anda.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Form submit loading state
    document.querySelector('form').addEventListener('submit', function() {
        const submitBtn = document.getElementById('submit-btn');
        const submitText = document.getElementById('submit-text');
        const loadingText = document.getElementById('loading-text');

        submitBtn.disabled = true;
        submitText.classList.add('hidden');
        loadingText.classList.remove('hidden');
    });

    // File upload preview enhancement
    document.getElementById('file-upload').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Optional: Add file size validation
            if (file.size > 5 * 1024 * 1024) { // 5MB
                alert('File terlalu besar! Maksimal 5MB.');
                e.target.value = '';
                return;
            }

            // Optional: Add file type validation
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'application/pdf', 'image/webp'];
            if (!allowedTypes.includes(file.type)) {
                alert('Tipe file tidak didukung! Gunakan JPG, PNG, GIF, WEBP, atau PDF.');
                e.target.value = '';
                return;
            }
        }
    });
</script>
@endpush
@endsection
