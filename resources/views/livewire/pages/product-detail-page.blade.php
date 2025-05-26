<div>
<div>
    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
        <section class="overflow-hidden bg-white shadow-lg py-11 font-poppins dark:bg-gray-800 rounded-2xl">
            <div class="max-w-6xl px-4 py-4 mx-auto lg:py-8 md:px-6">
                <!-- Breadcrumb -->
                <nav class="flex mb-6">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-300 dark:hover:text-white">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                                Home
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <a href="{{ route('kategori', $produk->kategori) }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">{{ $produk->kategori->name }}</a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">{{ $produk->name }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>

                <div class="flex flex-wrap -mx-4">
                    {{-- LEFT IMAGE --}}
                    <div class="w-full mb-8 md:w-1/2 md:mb-0"
                         x-data="{
                            mainImage: '{{ $produk->images[0] ? url('storage/' . $produk->images[0]) : '' }}',
                            zoom: false,
                            zoomX: 0,
                            zoomY: 0,
                            handleMouseMove(e) {
                                if (!this.zoom) return;
                                const bounds = e.target.getBoundingClientRect();
                                const x = e.clientX - bounds.left;
                                const y = e.clientY - bounds.top;
                                this.zoomX = (x / bounds.width) * 100;
                                this.zoomY = (y / bounds.height) * 100;
                            }
                         }">
                        <div class="sticky top-0 z-10 overflow-hidden">
                            <div class="relative mb-6 lg:mb-10 group">
                                <div class="relative overflow-hidden rounded-lg shadow-lg bg-gray-50">
                                    <img
                                        x-bind:src="mainImage"
                                        alt="{{ $produk->name }}"
                                        class="object-cover w-full h-[450px] rounded-lg transition-transform duration-500 ease-in-out transform hover:scale-105"
                                        @mousemove="handleMouseMove"
                                        @mouseenter="zoom = true"
                                        @mouseleave="zoom = false"
                                    />

                                    <!-- Zoom overlay -->
                                    <div
                                        x-show="zoom"
                                        class="absolute top-0 left-0 w-32 h-32 border-2 border-blue-500 rounded-full pointer-events-none"
                                        x-bind:style="`left: calc(${zoomX}% - 64px); top: calc(${zoomY}% - 64px);`"
                                    ></div>
                                </div>

                                @if($produk->on_sale)
                                    <div class="absolute top-4 left-4">
                                        <span class="px-3 py-1.5 text-xs font-medium tracking-wider text-white uppercase bg-red-600 rounded-full">Sale</span>
                                    </div>
                                @endif
                            </div>

                            @if($produk->images && count($produk->images) > 1)
                                <div class="flex-wrap hidden gap-2 md:flex">
                                    @foreach($produk->images as $image)
                                        <div class="w-1/4 p-1">
                                            <img
                                                src="{{ url('storage/' . $image) }}"
                                                alt="Thumbnail"
                                                @click="mainImage = '{{ url('storage/' . $image) }}'"
                                                :class="{'ring-2 ring-blue-500 ring-offset-2': mainImage === '{{ url('storage/' . $image) }}'}"
                                                class="object-cover w-full h-24 transition-all duration-300 rounded-lg shadow cursor-pointer hover:shadow-md" />
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <!-- Mobile Image Carousel Dots -->
                            @if($produk->images && count($produk->images) > 1)
                                <div class="flex justify-center mt-4 space-x-2 md:hidden">
                                    @foreach($produk->images as $index => $image)
                                        <button
                                            @click="mainImage = '{{ url('storage/' . $image) }}'"
                                            :class="{'bg-blue-600': mainImage === '{{ url('storage/' . $image) }}', 'bg-gray-300': mainImage !== '{{ url('storage/' . $image) }}'}"
                                            class="w-3 h-3 rounded-full focus:outline-none">
                                        </button>
                                    @endforeach
                                </div>
                            @endif

                            <div class="px-6 pb-6 mt-6 border-t border-gray-200 dark:border-gray-700">
                                <div class="flex flex-wrap items-center mt-4 space-y-2 md:space-y-0">


                                    <div class="flex items-center w-full gap-2 md:w-1/3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Quality Guarantee</span>
                                    </div>

                                    <div class="flex items-center w-full gap-2 md:w-1/3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                        </svg>
                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Easy Returns</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- RIGHT DETAIL --}}
                    <div class="w-full px-4 md:w-1/2">
                        <div class="lg:pl-10">
                            <div class="mb-8">
                                <div class="flex flex-wrap items-center mb-6">
                                    <h2 class="text-3xl font-bold text-gray-800 dark:text-white">{{ $produk->name }}</h2>

                                    <!-- Status Badges -->
                                    <div class="flex flex-wrap ml-auto">
                                        @if($produk->on_sale)
                                            <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-100 text-red-800 mr-2">
                                                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                    <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                                                </svg>
                                                Sale
                                            </span>
                                        @endif

                                        @if($produk->is_featured)
                                            <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mr-2">
                                                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                </svg>
                                                Favorite
                                            </span>
                                        @endif

                                        @if($produk->in_stock)
                                            <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                                </svg>
                                                In Stock
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                </svg>
                                                Stok Habis
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <a href="{{ route('kategori', $produk->kategori) }}" class="inline-block mb-4 text-lg font-semibold text-blue-600 transition-colors duration-300 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                    {{ $produk->kategori->name }}
                                </a>



                                <div class="flex flex-col mb-6">

                                        <p class="text-3xl font-bold text-green-600 dark:text-green-400">
                                            Rp{{ number_format($produk->harga, 0, ',', '.') }}
                                        </p>

                                </div>

                                <div class="mb-6">
                                    <h3 class="mb-2 text-lg font-semibold text-gray-800 dark:text-white">Deskripsi</h3>
                                    <div class="space-y-2 text-gray-600 dark:text-gray-300">
                                        {{ $produk->deskripsi }}
                                    </div>
                                </div>
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                {{-- Add to Cart Button --}}
                                <button
                                    type="button"
                                    wire:click="addToCart({{ $produk->id }}, $event.target.getAttribute('data-quantity'))"
                                    x-bind:data-quantity="quantity"
                                    class="flex items-center justify-center w-full px-4 py-3 text-base font-medium text-white transition duration-300 bg-blue-600 rounded-lg gap-x-2 hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed disabled:bg-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                                    {{ !$produk->in_stock ? 'disabled' : '' }}
                                >
                                    <svg class="flex-shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
                                        <line x1="3" y1="6" x2="21" y2="6"/>
                                        <path d="M16 10a4 4 0 0 1-8 0"/>
                                    </svg>
                                    {{ $produk->in_stock ? 'Tambah ke Keranjang' : 'Stok Habis' }}
                                </button>


                            </div>

                            <!-- Share Buttons -->
                            <div class="flex items-center mt-6">
                                <span class="mr-4 text-sm font-medium text-gray-600 dark:text-gray-400">Share:</span>
                                <div class="flex space-x-2">
                                    <a href="#" class="text-gray-500 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                    <a href="#" class="text-gray-500 hover:text-blue-400 dark:text-gray-400 dark:hover:text-blue-400">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                                        </svg>
                                    </a>
                                    <a href="#" class="text-gray-500 hover:text-pink-600 dark:text-gray-400 dark:hover:text-pink-400">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                    <a href="#" class="text-gray-500 hover:text-red-600 dark:text-gray-400 dark:hover:text-red-400">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path d="M12 2C6.477 2 2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.879V14.89h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.093 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.989C18.343 21.129 22 16.99 22 12c0-5.523-4.477-10-10-10z"></path>
                                        </svg>
                                    </a>
                                    <a href="#" class="text-gray-500 hover:text-red-600 dark:text-gray-400 dark:hover:text-red-400">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path d="M9.5 1.938A7.5 7.5 0 1 0 21 11.99V7h3V4h-3V1.5h-3v2.738A7.468 7.468 0 0 0 12 1.5c-.86 0-1.693.146-2.5.438zM12 13.5a4.5 4.5 0 1 1 0-9 4.5 4.5 0 0 1 0 9z"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            <!-- Tab Section (Details / Reviews / FAQ) -->
                            <div class="mt-8" x-data="{ activeTab: 'description' }">
                                <div class="border-b border-gray-200 dark:border-gray-700">
                                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center">
                                        <li class="mr-2">
                                            <button @click="activeTab = 'description'" :class="{ 'border-b-2 border-blue-600 text-blue-600 dark:text-blue-400 dark:border-blue-400': activeTab === 'description', 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300': activeTab !== 'description' }" class="inline-block p-4 rounded-t-lg">
                                                Deskripsi
                                            </button>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Tab Content -->
                                <div class="mt-4">
                                    <!-- Description Tab -->
                                    <div x-show="activeTab === 'description'" class="space-y-4">
                                        <div class="text-gray-600 dark:text-gray-300">
                                            {{ $produk->deskripsi_lengkap ?? $produk->deskripsi }}
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Related Products -->
                <div class="mt-16">
    <h2 class="mb-8 text-3xl font-bold text-gray-800 dark:text-white">Produk Terkait</h2>

    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($relatedProducts ?? [] as $related)
        <div class="overflow-hidden transition-shadow duration-300 bg-white shadow-lg rounded-xl dark:bg-gray-700 group hover:shadow-xl">
            <a href="{{ route('produk.show', $related) }}" class="relative block h-64 overflow-hidden">
                <img src="{{ $related->image_url ?? url('storage/' . $related->images[0]) }}" alt="{{ $related->name }}" class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-105">
                @if($related->on_sale)
                <span class="absolute px-3 py-1 text-sm font-semibold text-white bg-red-500 rounded-lg top-3 left-3">Sale</span>
                @endif
            </a>

            <div class="p-6">
                <a href="{{ route('kategori', $related->kategori) }}" class="text-sm font-medium text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                    {{ $related->kategori->name }}
                </a>

                <a href="{{ route('produk.show', $related) }}" class="block mt-3 text-xl font-semibold text-gray-800 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 line-clamp-2">
                    {{ $related->name }}
                </a>

                <div class="flex items-center justify-between mt-6">
                    <div>
                        <span class="text-xl font-bold text-green-600 dark:text-green-400">Rp{{ number_format($related->harga, 0, ',', '.') }}</span>
                    </div>

                    <button type="button" wire:click="addToCart({{ $related->id }})" class="p-3 text-white transition-all duration-200 bg-blue-600 rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 disabled:opacity-50 disabled:cursor-not-allowed hover:scale-105" {{ !$related->in_stock ? 'disabled' : '' }}>
                        @if(isset($loadingCart[$related->id]) && $loadingCart[$related->id])
                            <svg class="w-6 h-6 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        @else
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        @endif
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-3 py-16 text-center">
            <div class="max-w-md mx-auto">
                <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                <h3 class="mb-2 text-lg font-medium text-gray-900 dark:text-white">Tidak ada produk terkait</h3>
                <p class="text-gray-500 dark:text-gray-400">Produk terkait belum tersedia saat ini.</p>
            </div>
        </div>
        @endforelse
    </div>
</div>
            </div>
        </section>
    </div>
</div>

{{-- Notification --}}
<div
    x-data="{ show: false, message: '' }"
    @add-to-cart.window="message = 'Produk berhasil ditambahkan ke keranjang!'; show = true; setTimeout(() => { show = false }, 3000)"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform scale-90"
    x-transition:enter-end="opacity-100 transform scale-100"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 transform scale-100"
    x-transition:leave-end="opacity-0 transform scale-90"
    class="fixed z-50 flex items-center p-4 mb-4 text-green-800 rounded-lg bottom-4 right-4 bg-green-50 dark:bg-gray-800 dark:text-green-400"
    role="alert">
    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
        </svg>
        <span class="sr-only">Success icon</span>
    </div>
    <div class="ml-3 text-sm font-normal" x-text="message"></div>
    <button type="button" @click="show = false" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
    </button>
</div>

</div>
