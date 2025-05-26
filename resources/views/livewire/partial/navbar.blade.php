<header class="sticky top-0 z-50 flex flex-wrap w-full py-3 text-sm bg-white shadow-md md:justify-start md:flex-nowrap md:py-0 dark:bg-gray-800">
    <nav class="max-w-[85rem] w-full mx-auto px-4 md:px-6 lg:px-8" aria-label="Global">
      <div class="relative md:flex md:items-center md:justify-between">
        <div class="flex items-center justify-between">
          <a class="flex-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="/" aria-label="Brand">
            <img src="{{ asset('logo.svg') }}" alt="Lestari Adv" class="h-10 md:h-12">
          </a>
          <div class="md:hidden">
            <button type="button" class="flex items-center justify-center text-sm font-semibold text-gray-800 border border-gray-200 rounded-lg hs-collapse-toggle w-9 h-9 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" data-hs-collapse="#navbar-collapse-with-animation" aria-controls="navbar-collapse-with-animation" aria-label="Toggle navigation">
              <svg class="flex-shrink-0 w-4 h-4 hs-collapse-open:hidden" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="3" x2="21" y1="6" y2="6" />
                <line x1="3" x2="21" y1="12" y2="12" />
                <line x1="3" x2="21" y1="18" y2="18" />
              </svg>
              <svg class="flex-shrink-0 hidden w-4 h-4 hs-collapse-open:block" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 6 6 18" />
                <path d="m6 6 12 12" />
              </svg>
            </button>
          </div>
        </div>

        <div id="navbar-collapse-with-animation" class="hidden overflow-hidden transition-all duration-300 hs-collapse basis-full grow md:block">
            <div class="overflow-hidden overflow-y-auto max-h-[75vh] [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-slate-700 dark:[&::-webkit-scrollbar-thumb]:bg-slate-500">
              <div class="flex flex-col mt-5 divide-y divide-gray-200 gap-x-0 divide-dashed md:flex-row md:items-center md:justify-end md:gap-x-7 md:mt-0 md:ps-7 md:divide-y-0 md:divide-solid dark:divide-gray-700">

                <a class="py-3 font-medium {{ request()->is('/') ? 'text-blue-600 dark:text-blue-500 border-b-2 border-blue-600 md:border-b-2' : 'text-gray-500 hover:text-blue-600 hover:border-b-2 hover:border-blue-600' }} md:py-6 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="/" aria-current="page">Home</a>

                <a class="py-3 font-medium {{ request()->is('categories') ? 'text-blue-600 dark:text-blue-500 border-b-2 border-blue-600 md:border-b-2' : 'text-gray-500 hover:text-blue-600 hover:border-b-2 hover:border-blue-600' }} md:py-6 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="/categories">
                  Categories
                </a>

                <a class="py-3 font-medium {{ request()->is('products') ? 'text-blue-600 dark:text-blue-500 border-b-2 border-blue-600 md:border-b-2' : 'text-gray-500 hover:text-blue-600 hover:border-b-2 hover:border-blue-600' }} md:py-6 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="/products">
                  Products
                </a>

                <a class="flex items-center py-3 font-medium {{ request()->is('cart') ? 'text-blue-600 dark:text-blue-500 border-b-2 border-blue-600 md:border-b-2' : 'text-gray-500 hover:text-blue-600 hover:border-b-2 hover:border-blue-600' }} md:py-6 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="/cart">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="flex-shrink-0 w-5 h-5 mr-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                  </svg>
                  <span class="mr-1">Cart</span> <span class="py-0.5 px-1.5 rounded-full text-xs font-medium bg-blue-50 border border-blue-200 text-blue-600">{{ $total_count }}</span>
                </a>

                @guest

                <div class="pt-3 md:pt-0">
                  <a class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="/login">
                    <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                      <circle cx="12" cy="7" r="4" />
                    </svg>
                    Log in
                  </a>
                </div>

                @endguest
              </div>
            </div>
          </div>

         @auth
<div class="hs-dropdown [--strategy:static] md:[--strategy:fixed] [--adaptive:none] md:[--trigger:hover] md:py-4">
    <button type="button" class="flex items-center w-full font-medium text-gray-500 hover:text-gray-400 dark:text-gray-400 dark:hover:text-gray-500">
        {{ auth()->user()->name }}
        <svg class="w-4 h-4 ms-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m6 9 6 6 6-6" />
        </svg>
    </button>

    <div class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 md:w-48 hidden z-10 bg-white md:shadow-md rounded-lg p-2 dark:bg-gray-800 md:dark:border dark:border-gray-700 dark:divide-gray-700 before:absolute top-full md:border before:-top-5 before:start-0 before:w-full before:h-5">

        {{-- Menu untuk semua user --}}
        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="{{ route('my-orders') }}">
            My Orders
        </a>

        {{-- Menu khusus admin --}}
        @if(auth()->user()->name === 'admin' && auth()->user()->email === 'admin@gmail.com')
            <div class="my-2 border-t border-gray-200 dark:border-gray-700"></div>
            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-orange-600 hover:bg-orange-50 focus:ring-2 focus:ring-orange-500 dark:text-orange-400 dark:hover:bg-orange-900/20 dark:hover:text-orange-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-orange-600 font-medium" href="/admin">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Admin Panel
            </a>
        @endif

        {{-- Menu logout untuk semua user --}}
        <div class="my-2 border-t border-gray-200 dark:border-gray-700"></div>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <a href="#" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
        Logout
    </a>
</form>

    </div>
</div>
@endauth

            </div>
          </div>
        </div>
      </div>
    </nav>
  </header>
