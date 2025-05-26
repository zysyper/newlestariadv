@extends('layouts.app')

@section('content')
<div>
    <div class="w-full h-screen px-4 py-10 mx-auto bg-gradient-to-r from-blue-200 to-cyan-200 sm:px-6 lg:px-8">
        <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
          <!-- Grid -->
          <div class="grid gap-4 md:grid-cols-2 md:gap-8 xl:gap-20 md:items-center">
            <div>
              <h1 class="block text-3xl font-bold text-gray-800 sm:text-4xl lg:text-6xl lg:leading-tight dark:text-white">Trophy Berkualitas untuk <span class="text-blue-600">Berbagai Acara</span></h1>
              <p class="mt-3 text-lg text-gray-800 dark:text-gray-400">Kami menyediakan berbagai jenis trophy dan lainnya untuk kebutuhan penghargaan, kompetisi, dan acara spesial Anda.</p>

             <!-- Buttons -->
                <div class="grid w-full gap-4 mt-8 sm:inline-flex">
                    <a class="inline-flex items-center justify-center px-6 py-4 text-base font-semibold text-white bg-blue-600 border border-transparent rounded-lg gap-x-3 hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="{{ route('kategori') }}">
                    Produk
                    <svg class="flex-shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m9 18 6-6-6-6" />
                    </svg>
                    </a>
                </div>
                <!-- End Buttons -->
            </div>
          </div>
          <!-- End Grid -->
        </div>
    </div>

    <div>
        <div class="py-16 bg-gray-100">
            <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto">
                <!-- Section Header -->
                <div class="max-w-xl mx-auto mb-10">
                    <div class="text-center ">
                        <div class="relative flex flex-col items-center">
                            <h1 class="text-5xl font-bold dark:text-gray-200">Produk <span class="text-blue-500">Terbaru</span></h1>
                            <div class="flex w-40 mt-2 mb-6 overflow-hidden rounded">
                                <div class="flex-1 h-2 bg-blue-200"></div>
                                <div class="flex-1 h-2 bg-blue-400"></div>
                                <div class="flex-1 h-2 bg-blue-600"></div>
                            </div>
                        </div>
                        <p class="mb-8 text-base text-center text-gray-500">
                            Temukan koleksi trophy terbaru kami dengan desain eksklusif dan kualitas premium
                        </p>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    @forelse ($produks as $produk)
                        <div class="group flex flex-col h-full bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-700 dark:shadow-slate-700/[.7]">
                            <div class="flex flex-col items-center justify-center bg-blue-100 h-52 rounded-t-xl">
                                @if(!empty($produk->images) && is_array($produk->images) && count($produk->images) > 0)
                                    <img class="object-cover w-full h-full rounded-t-xl" src="{{ url('storage', $produk->images[0]) }}" alt="{{ $produk->name }}">
                                @else
                                    <div class="flex items-center justify-center w-full h-full bg-gray-200 rounded-t-xl">
                                        <svg class="w-12 h-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="p-4 md:p-6">
                                <span class="block mb-1 text-xs font-semibold text-blue-600 uppercase dark:text-blue-500">
                                    {{ $produk->kategori->name ?? 'Umum' }}
                                </span>
                                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-300">
                                    {{ $produk->name }}
                                </h3>
                                <p class="mt-3 text-gray-500">
                                    {{ Str::limit($produk->deskripsi, 100) }}
                                </p>
                                <p class="mt-3 text-xl font-bold text-gray-800 dark:text-gray-300">
                                    Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                </p>

                                @if(isset($produk->on_sale) && $produk->on_sale)
                                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 mt-2 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                            <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                                        </svg>
                                        Sale
                                    </span>
                                @endif

                                @if(isset($produk->is_featured) && $produk->is_featured)
                                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 mt-2 ml-2 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                        </svg>
                                        Favorite
                                    </span>
                                @endif

                                @if(isset($produk->in_stock) && !$produk->in_stock)
                                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 mt-2 ml-2 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                        </svg>
                                        Stok Habis
                                    </span>
                                @endif
                            </div>
                            <div class="mt-auto border-t border-gray-200 dark:border-gray-700">
                                <a class="inline-flex items-center justify-center w-full px-4 py-3 text-sm font-medium text-white bg-blue-600 shadow-sm gap-x-2 rounded-b-xl hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-blue-500" href="{{ route('produk.detail', $produk->slug ?? $produk->id) }}">
                                    Detail Produk
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="py-10 text-center col-span-full">
                            <svg class="w-12 h-12 mx-auto text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/>
                                <line x1="8" y1="21" x2="16" y2="21"/>
                                <line x1="12" y1="17" x2="12" y2="21"/>
                            </svg>
                            <h3 class="mt-2 text-sm font-semibold text-gray-800 dark:text-gray-200">Tidak ada produk</h3>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $produks->links() }}
                </div>
            </div>
        </div>
    </div>

    <!--Kategoris -->
    <div class="py-20 bg-gray-200">
        <div class="max-w-xl mx-auto">
          <div class="text-center ">
            <div class="relative flex flex-col items-center">
              <h1 class="text-5xl font-bold dark:text-gray-200"> Kategori <span class="text-blue-500"> Produk
                </span> </h1>
              <div class="flex w-40 mt-2 mb-6 overflow-hidden rounded">
                <div class="flex-1 h-2 bg-blue-200">
                </div>
                <div class="flex-1 h-2 bg-blue-400">
                </div>
                <div class="flex-1 h-2 bg-blue-600">
                </div>
              </div>
            </div>
            <p class="mb-12 text-base text-center text-gray-500">
              Kami menyediakan berbagai kategori produk sesuai yang anda butuhkan
            </p>
          </div>
        </div>

        <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto">
          <div class="grid gap-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 sm:gap-6">
            @foreach ($kategoris as $kategori)
                <a class="flex flex-col transition bg-white border shadow-sm group rounded-xl hover:shadow-lg dark:bg-slate-900 dark:border-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="{{ route('produk') }}?categories[0]={{ $kategori->id }}">
                    <div class="p-6 md:p-8">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img class="w-16 h-16 rounded-full" src="{{ url('storage', $kategori->image) }}" alt="{{ $kategori->name }}">
                                <div class="ms-4">
                                    <h3 class="text-lg font-semibold text-gray-800 group-hover:text-blue-600 dark:group-hover:text-gray-400 dark:text-gray-200">
                                        {{ $kategori->name }}
                                    </h3>
                                </div>
                            </div>
                            <div class="ps-4">
                                <svg class="flex-shrink-0 w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m9 18 6-6-6-6" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
          </div>
        </div>
    </div>
</div>
@endsection
