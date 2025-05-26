<div>
    <div class="w-full max-w-[85rem] py-12 px-4 sm:px-6 lg:px-8 mx-auto">
        <section class="py-12 shadow-lg rounded-xl bg-gradient-to-br from-gray-50 to-gray-100 font-poppins dark:from-gray-800 dark:to-gray-900">
          <div class="px-4 py-4 mx-auto max-w-7xl lg:py-6 md:px-6">
            <!-- Page Title -->
            <div class="mb-10 text-center">
              <h1 class="text-3xl font-bold text-gray-800 dark:text-white md:text-4xl">
                Products
              </h1>
              <div class="flex justify-center mt-4">
                <div class="w-20 h-1 bg-blue-600 rounded-full"></div>
              </div>
              <p class="max-w-2xl mx-auto mt-4 text-gray-600 dark:text-gray-300">
                Kami menyediakan berbagai jenis trophy dan lainnya untuk kebutuhan penghargaan, kompetisi, dan acara spesial Anda
              </p>
            </div>

            <!-- Search Bar -->
            <div class="max-w-xl mx-auto mb-10">
              <div class="relative flex">
                <input type="text" wire:model.live.debounce.300ms="search"
                       class="w-full py-3 pl-4 pr-12 text-gray-700 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:text-gray-300 dark:border-gray-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20"
                       placeholder="Search products...">
                <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400">
                  <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                  </svg>
                </span>
              </div>
            </div>

            <div class="flex flex-wrap mb-24 -mx-3">
              <!-- Sidebar Filters -->
              <div class="w-full pr-2 lg:w-1/4 lg:block">
                <!-- Mobile Filter Toggle -->
                <div class="block mb-6 lg:hidden">
                  <button wire:click="$toggle('showFilters')" class="flex items-center justify-between w-full px-4 py-3 text-sm font-medium text-left text-gray-700 bg-white border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-700">
                    <span class="flex items-center">
                      <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                      </svg>
                      Filters
                    </span>
                    <svg x-bind:class="showFilters ? 'rotate-180' : ''" class="w-5 h-5 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </button>
                </div>

                <div x-data="{ activeTab: 'categories' }" class="space-y-6 lg:block" x-show="$wire.showFilters || window.innerWidth >= 1024" x-transition>
                  <!-- kategoris -->
                  <div class="p-5 transition-all duration-300 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800 hover:shadow-md">
                    <div @click="activeTab = activeTab === 'kategoris' ? null : 'categories'" class="flex items-center justify-between cursor-pointer">
                      <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200">Kategori</h2>
                      <svg x-bind:class="activeTab === 'categories' ? 'rotate-180' : ''" class="w-5 h-5 text-gray-500 transition-transform duration-200 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                      </svg>
                    </div>
                    <div class="w-full h-1 mt-2 rounded-full bg-gradient-to-r from-blue-500 to-blue-600"></div>
                    <ul x-show="activeTab === 'categories'" x-transition class="mt-4 space-y-3">
                      @foreach($kategoris as $kategori)
                      <li>
                        <label class="flex items-center group">
                          <input type="checkbox" class="w-5 h-5 mr-3 text-blue-600 border-gray-300 rounded focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700" wire:model.live="categories" value="{{ $kategori->id }}">
                          <span class="text-gray-700 transition-colors duration-200 dark:text-gray-300 group-hover:text-blue-600 dark:group-hover:text-blue-400">{{ $kategori->name }}</span>
                        </label>
                      </li>
                      @endforeach
                    </ul>
                  </div>

                  <!-- Product Status -->
                  <div class="p-5 transition-all duration-300 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800 hover:shadow-md">
                    <div @click="activeTab = activeTab === 'status' ? null : 'status'" class="flex items-center justify-between cursor-pointer">
                      <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200">Product Status</h2>
                      <svg x-bind:class="activeTab === 'status' ? 'rotate-180' : ''" class="w-5 h-5 text-gray-500 transition-transform duration-200 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                      </svg>
                    </div>
                    <div class="w-full h-1 mt-2 rounded-full bg-gradient-to-r from-blue-500 to-blue-600"></div>
                    <ul x-show="activeTab === 'status'" x-transition class="mt-4 space-y-3">
                      <li>
                        <label class="flex items-center group">
                          <input type="checkbox" class="w-5 h-5 mr-3 text-blue-600 border-gray-300 rounded focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700" wire:model.live="inStock">
                          <span class="text-gray-700 transition-colors duration-200 dark:text-gray-300 group-hover:text-blue-600 dark:group-hover:text-blue-400">In Stock</span>
                        </label>
                      </li>
                      <li>
                        <label class="flex items-center group">
                          <input type="checkbox" class="w-5 h-5 mr-3 text-blue-600 border-gray-300 rounded focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700" wire:model.live="onSale">
                          <span class="text-gray-700 transition-colors duration-200 dark:text-gray-300 group-hover:text-blue-600 dark:group-hover:text-blue-400">On Sale</span>
                        </label>
                      </li>
                      <li>
                        <label class="flex items-center group">
                          <input type="checkbox" class="w-5 h-5 mr-3 text-blue-600 border-gray-300 rounded focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700" wire:model.live="featured">
                          <span class="text-gray-700 transition-colors duration-200 dark:text-gray-300 group-hover:text-blue-600 dark:group-hover:text-blue-400">Favorite</span>
                        </label>
                      </li>
                    </ul>
                  </div>

                  <!-- Price Range -->
                  <div class="p-5 transition-all duration-300 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800 hover:shadow-md">
                    <div @click="activeTab = activeTab === 'price' ? null : 'price'" class="flex items-center justify-between cursor-pointer">
                      <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200">Price Range</h2>
                      <svg x-bind:class="activeTab === 'price' ? 'rotate-180' : ''" class="w-5 h-5 text-gray-500 transition-transform duration-200 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                      </svg>
                    </div>
                    <div class="w-full h-1 mt-2 rounded-full bg-gradient-to-r from-blue-500 to-blue-600"></div>
                    <div x-show="activeTab === 'price'" x-transition class="mt-4">
                      <div class="relative">
                        <input type="range"
                               class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
                               min="1000" max="2000000" wire:model.live="maxPrice" step="50000">
                        <div class="absolute left-0 right-0 h-2 pointer-events-none -bottom-1">
                          <div class="h-2 bg-blue-500 rounded-l-lg" style="width: calc({{ ($maxPrice - 1000) / (2000000 - 1000) * 100 }}%)"></div>
                        </div>
                      </div>
                      <div class="flex justify-between mt-4">
                        <span class="inline-block text-sm font-medium text-gray-700 dark:text-gray-300">Rp 1.000</span>
                        <span class="inline-block text-sm font-medium text-blue-600 dark:text-blue-400">Rp {{ number_format($maxPrice ?? 2000000, 0, ',', '.') }}</span>
                      </div>
                    </div>
                  </div>

                  <!-- Clear Filters Button -->
                  <div class="flex justify-center">
                    <button wire:click="resetFilters" class="px-4 py-2 text-sm font-medium text-blue-600 transition-colors duration-200 bg-blue-100 rounded-lg hover:bg-blue-200 dark:bg-blue-900 dark:text-blue-300 dark:hover:bg-blue-800">
                      <span class="flex items-center">
                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Reset Filters
                      </span>
                    </button>
                  </div>
                </div>
              </div>

              <!-- Product Grid -->
              <div class="w-full px-3 lg:w-3/4">
                <!-- Sorting and View Options -->
                <div class="mb-6">
                  <div class="flex flex-col px-4 py-3 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex-row sm:items-center sm:justify-between dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-3 sm:mb-0">
                      <span class="text-sm text-gray-500 dark:text-gray-400">
                        Showing
                        <span class="font-medium text-gray-700 dark:text-gray-300">{{ $produks->firstItem() ?? 0 }}</span>
                        to
                        <span class="font-medium text-gray-700 dark:text-gray-300">{{ $produks->lastItem() ?? 0 }}</span>
                        of
                        <span class="font-medium text-gray-700 dark:text-gray-300">{{ $produks->total() ?? 0 }}</span>
                        products
                      </span>
                    </div>
                    <div class="flex items-center space-x-4">

                      <div class="relative">
                        <select wire:model.live="sortBy" class="py-2 pl-3 pr-8 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg appearance-none cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-700">
                          <option value="latest">Sort by latest</option>
                          <option value="price-asc">Price: Low to High</option>
                          <option value="price-desc">Price: High to Low</option>
                          <option value="name">Name: A to Z</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                          <svg class="w-4 h-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                          </svg>
                        </div>
                      </div>
                      <div class="hidden space-x-2 sm:flex">
                        <button wire:click="$set('viewMode', 'grid')" class="p-2 text-gray-500 bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-blue-50 dark:hover:bg-gray-700" :class="{'text-blue-600 bg-blue-50 border-blue-200 dark:bg-blue-900 dark:border-blue-800 dark:text-blue-400': $wire.viewMode === 'grid'}">
                          <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                          </svg>
                        </button>
                        <button wire:click="$set('viewMode', 'list')" class="p-2 text-gray-500 bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-blue-50 dark:hover:bg-gray-700" :class="{'text-blue-600 bg-blue-50 border-blue-200 dark:bg-blue-900 dark:border-blue-800 dark:text-blue-400': $wire.viewMode === 'list'}">
                          <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                          </svg>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Products Grid -->
                <div x-show="$wire.viewMode === 'grid'" x-transition class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @forelse ($produks as $produk)
                        <div wire:key="{{ $produk->id }}" class="relative flex flex-col h-full overflow-hidden transition-all duration-300 bg-white border border-gray-200 shadow-sm group rounded-xl hover:shadow-lg dark:bg-gray-800 dark:border-gray-700">
                            <!-- Badges (Positioned absolute) -->
                            <div class="absolute z-10 flex flex-col space-y-1 top-2 left-2">
                                @if($produk->on_sale)
                                    <span class="inline-flex items-center justify-center h-6 px-3 text-xs font-medium text-white bg-red-500 rounded-full shadow-md">
                                        Sale
                                    </span>
                                @endif
                                @if($produk->is_featured)
                                    <span class="inline-flex items-center justify-center h-6 px-3 text-xs font-medium text-white bg-blue-500 rounded-full shadow-md">
                                        Favorite
                                    </span>
                                @endif
                                @if(!$produk->in_stock)
                                    <span class="inline-flex items-center justify-center h-6 px-3 text-xs font-medium text-white bg-gray-700 rounded-full shadow-md">
                                        Out of Stock
                                    </span>
                                @endif
                            </div>

                            <!-- Product Image with overlay effect -->
                            <div class="relative overflow-hidden group">
                                <div class="bg-gray-100 aspect-w-4 aspect-h-3 dark:bg-gray-700">
                                    @if(!empty($produk->images) && is_array($produk->images) && count($produk->images) > 0)
                                        <img class="object-cover w-full h-full transition-transform duration-500 transform group-hover:scale-110" src="{{ url('storage', $produk->images[0]) }}" alt="{{ $produk->name }}">
                                    @else
                                        <div class="flex items-center justify-center w-full h-full bg-gray-200 dark:bg-gray-700">
                                            <svg class="w-12 h-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="absolute inset-0 transition-opacity duration-300 opacity-0 bg-gradient-to-t from-black/80 via-black/0 to-black/0 group-hover:opacity-100"></div>
                            </div>

                            <!-- Product Info -->
                            <div class="flex-grow p-4">
                                <span class="block mb-1 text-xs font-semibold tracking-wider text-blue-600 uppercase dark:text-blue-400">
                                    {{ $produk->kategori->name ?? 'Umum' }}
                                </span>
                                <h3 class="mb-2 text-lg font-bold text-gray-800 transition-colors duration-200 hover:text-blue-600 dark:text-gray-200 dark:hover:text-blue-400">
                                    <a href="/products/{{ $produk->slug }}">{{ $produk->name }}</a>
                                </h3>

                                <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-2">
                                    {{ Str::limit($produk->deskripsi, 100) }}
                                </p>
                            </div>

                            <!-- Price and Action -->
                            <div class="p-4 pt-0 mt-auto">
                                <div class="flex items-center justify-between mb-4">
                                    @if($produk->on_sale && isset($produk->original_price))
                                        <div>
                                            <span class="text-xl font-bold text-gray-800 dark:text-gray-200">
                                                Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                            </span>
                                            <span class="ml-2 text-sm text-gray-500 line-through dark:text-gray-400">
                                                Rp {{ number_format($produk->original_price, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    @else
                                        <span class="text-xl font-bold text-gray-800 dark:text-gray-200">
                                            Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                        </span>
                                    @endif
                                    <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-medium {{ $produk->in_stock ? 'text-green-800 bg-green-100 dark:bg-green-900 dark:text-green-300' : 'text-red-800 bg-red-100 dark:bg-red-900 dark:text-red-300' }} rounded-full">
                                        {{ $produk->in_stock ? 'In Stock' : 'Out of Stock' }}
                                    </span>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="/products/{{ $produk->slug }}" class="flex items-center justify-center flex-1 px-4 py-2 text-sm font-medium text-white transition-colors duration-200 bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Details
                                    </a>
                                    <button wire:click.prevent="addToCart({{ $produk->id }})" class="flex items-center justify-center flex-1 px-4 py-2 text-sm font-medium text-blue-600 transition-colors duration-200 bg-blue-100 rounded-lg hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed dark:bg-blue-900 dark:text-blue-300 dark:hover:bg-blue-800 dark:focus:ring-offset-gray-800" {{ !$produk->in_stock ? 'disabled' : '' }}>
                                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="py-10 text-center col-span-full">
                            <svg class="w-16 h-16 mx-auto text-gray-400 dark:text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-gray-800 dark:text-gray-200">No products found</h3>
                            <p class="mt-2 text-gray-500 dark:text-gray-400">Try adjusting your search or filter to find what you're looking for.</p>
                            <button wire:click="resetFilters" class="px-4 py-2 mt-4 text-sm font-medium text-white transition-colors duration-200 bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Reset All Filters
                            </button>
                        </div>
                    @endforelse
                </div>

                <!-- Products List View -->
                <div x-show="$wire.viewMode === 'list'" x-transition class="space-y-4">
                    @forelse ($produks as $produk)
                        <div wire:key="list-{{ $produk->id }}" class="flex flex-col overflow-hidden transition-all duration-300 bg-white border border-gray-200 shadow-sm group sm:flex-row rounded-xl hover:shadow-lg dark:bg-gray-800 dark:border-gray-700">
                            <!-- Product Image -->
                            <div class="relative w-full overflow-hidden sm:w-56 h-52">
                                <!-- Badges -->
                                <div class="absolute z-10 flex flex-col space-y-1 top-2 left-2">
                                    @if($produk->on_sale)
                                        <span class="inline-flex items-center justify-center h-6 px-3 text-xs font-medium text-white bg-red-500 rounded-full shadow-md">
                                            Sale
                                        </span>
                                    @endif
                                </div>

                                @if(!empty($produk->images) && is_array($produk->images) && count($produk->images) > 0)
                                    <img class="object-cover w-full h-full transition-transform duration-500 transform group-hover:scale-110" src="{{ url('storage', $produk->images[0]) }}" alt="{{ $produk->name }}">
                                @else
                                    <div class="flex items-center justify-center w-full h-full bg-gray-200 dark:bg-gray-700">
                                        <svg class="w-12 h-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <!-- Product Info -->
                            <div class="flex flex-col flex-grow p-4">
                                <div class="flex-grow">
                                    <div class="flex items-start justify-between mb-2">
                                        <div>
                                            <span class="inline-block px-2 py-1 text-xs font-medium text-blue-600 rounded-full bg-blue-50 dark:bg-blue-900 dark:text-blue-400">
                                                {{ $produk->kategori->name ?? 'Umum' }}
                                            </span>
                                            @if($produk->is_featured)
                                                <span class="inline-block px-2 py-1 ml-2 text-xs font-medium rounded-full text-amber-600 bg-amber-50 dark:bg-amber-900 dark:text-amber-400">
                                                    Favorite
                                                </span>
                                            @endif
                                        </div>
                                        <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-medium {{ $produk->in_stock ? 'text-green-800 bg-green-100 dark:bg-green-900 dark:text-green-300' : 'text-red-800 bg-red-100 dark:bg-red-900 dark:text-red-300' }} rounded-full">
                                            {{ $produk->in_stock ? 'In Stock' : 'Out of Stock' }}
                                        </span>
                                    </div>

                                    <h3 class="mb-2 text-lg font-bold text-gray-800 dark:text-gray-200">
                                        <a href="/products/{{ $produk->slug }}" class="transition-colors duration-200 hover:text-blue-600 dark:hover:text-blue-400">{{ $produk->name }}</a>
                                    </h3>

                                    <div class="flex items-center mb-3">
                                        <div class="flex items-center">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <svg class="w-4 h-4 {{ $i <= ($produk->rating ?? 4) ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @endfor
                                        </div>
                                        <span class="ml-2 text-xs text-gray-500 dark:text-gray-400">({{ $produk->reviews_count ?? rand(5, 50) }} reviews)</span>
                                    </div>

                                    <p class="mb-4 text-sm text-gray-500 dark:text-gray-400">
                                        {{ Str::limit($produk->deskripsi, 150) }}
                                    </p>
                                </div>

                                <div class="flex flex-col justify-between pt-4 border-t border-gray-200 sm:flex-row sm:items-center dark:border-gray-700">
                                    <div class="mb-4 sm:mb-0">
                                        @if($produk->on_sale && isset($produk->original_price))
                                            <div class="flex items-center">
                                                <span class="text-xl font-bold text-gray-800 dark:text-gray-200">
                                                    Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                                </span>
                                                <span class="ml-2 text-sm text-gray-500 line-through dark:text-gray-400">
                                                    Rp {{ number_format($produk->original_price, 0, ',', '.') }}
                                                </span>
                                                <span class="ml-2 px-2 py-0.5 text-xs font-medium text-white bg-red-500 rounded">
                                                    {{ round((($produk->original_price - $produk->harga) / $produk->original_price) * 100) }}% OFF
                                                </span>
                                            </div>
                                        @else
                                            <span class="text-xl font-bold text-gray-800 dark:text-gray-200">
                                                Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="/products/{{ $produk->slug }}" class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white transition-colors duration-200 bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                                            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Details
                                        </a>
                                        <button wire:click="$emit('addToCart', {{ $produk->id }})"  class="flex items-center justify-center px-4 py-2 text-sm font-medium text-blue-600 transition-colors duration-200 bg-blue-100 rounded-lg hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed dark:bg-blue-900 dark:text-blue-300 dark:hover:bg-blue-800 dark:focus:ring-offset-gray-800" {{ !$produk->in_stock ? 'disabled' : '' }}>
                                            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                            Add to Cart
                                        </button>
                                        <button class="flex items-center justify-center p-2 text-gray-500 transition-colors duration-200 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-offset-gray-800">
                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="py-10 text-center">
                            <svg class="w-16 h-16 mx-auto text-gray-400 dark:text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-gray-800 dark:text-gray-200">No products found</h3>
                            <p class="mt-2 text-gray-500 dark:text-gray-400">Try adjusting your search or filter to find what you're looking for.</p>
                            <button wire:click="resetFilters" class="px-4 py-2 mt-4 text-sm font-medium text-white transition-colors duration-200 bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Reset All Filters
                            </button>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                  <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                    {{ $produks->links() }}
                  </div>
                </div>
              </div>
            </div>


          </div>
        </section>
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

<!-- Alpine.js for interactive components -->
<script>
  document.addEventListener('alpine:init', () => {
    Alpine.data('productFilters', () => ({
      showFilters: window.innerWidth >= 1024,

      // For mobile responsiveness
      init() {
        window.addEventListener('resize', () => {
          if (window.innerWidth >= 1024) {
            this.showFilters = true;
          }
        });
      }
    }));
  });

</script>
