@extends('layouts.app')

@section('content')
<div>
    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
        <!-- Page Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Kategori Produk</h1>
            <p class="text-lg text-gray-600 dark:text-gray-400">Pilih kategori produk yang Anda inginkan</p>
        </div>

        <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
            <div class="grid gap-4 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 sm:gap-6">
                @forelse ($kategoris as $kategori)
                    <a class="flex flex-col transition bg-white border shadow-sm group rounded-xl hover:shadow-md dark:bg-slate-900 dark:border-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="{{ route('produk') }}?categories[0]={{ $kategori->id }}">
                        <div class="p-4 md:p-5">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    @if($kategori->image)
                                        <img class="h-[5rem] w-[5rem] rounded-lg object-cover" src="{{ url('storage', $kategori->image) }}" alt="{{ $kategori->name }}">
                                    @else
                                        <div class="h-[5rem] w-[5rem] rounded-lg bg-gray-200 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="ms-3">
                                        <h3 class="text-2xl font-semibold text-gray-800 group-hover:text-blue-600 dark:group-hover:text-gray-400 dark:text-gray-200">
                                            {{ $kategori->name }}
                                        </h3>
                                        @if($kategori->deskripsi)
                                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                                {{ Str::limit($kategori->deskripsi, 100) }}
                                            </p>
                                        @endif

                                        <!-- Product count (if you have this relationship) -->
                                        @if(method_exists($kategori, 'produks') && $kategori->produks_count ?? false)
                                            <span class="inline-flex items-center gap-1.5 py-1.5 px-3 mt-2 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ $kategori->produks_count }} Produk
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="ps-3">
                                    <svg class="flex-shrink-0 w-5 h-5 text-gray-400 group-hover:text-blue-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m9 18 6-6-6-6" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full py-10 text-center">
                        <svg class="w-12 h-12 mx-auto text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/>
                            <line x1="8" y1="21" x2="16" y2="21"/>
                            <line x1="12" y1="17" x2="12" y2="21"/>
                        </svg>
                        <h3 class="mt-2 text-sm font-semibold text-gray-800 dark:text-gray-200">Tidak ada kategori</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Belum ada kategori yang tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Back to Home Button -->
        <div class="text-center mt-8">
            <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection
