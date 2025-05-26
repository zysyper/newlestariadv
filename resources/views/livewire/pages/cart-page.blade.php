<div>
    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
        <div class="container px-4 mx-auto">
          <h1 class="mb-4 text-2xl font-semibold">Shopping Cart</h1>

          @if($hasItems)
          <div class="flex flex-col gap-4 md:flex-row">
            <div class="md:w-3/4">
              <div class="p-6 mb-4 overflow-x-auto bg-white rounded-lg shadow-md">
                <table class="w-full">
                  <thead>
                    <tr>
                      <th class="font-semibold text-left">Product</th>
                      <th class="font-semibold text-left">Price</th>
                      <th class="font-semibold text-left">Quantity</th>
                      <th class="font-semibold text-left">Total</th>
                      <th class="font-semibold text-left">Remove</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($cartItems as $index => $item)
                    <tr wire:key="cart-item-{{ $item['produk_id'] }}">
                      <td class="py-4">
                        <div class="flex items-center">
                          <img class="w-16 h-16 mr-4" src="{{ $this->getProductImageUrl($item) }}" alt="{{ $item['name'] }}">
                          <span class="font-semibold">{{ $item['name'] }}</span>
                        </div>
                      </td>
                      <td class="py-4">{{ $currency }}{{ number_format($item['unit_amount'], 2) }}</td>
                      <td class="py-4">
                        <div class="flex items-center">
                          <button
                            wire:click="decrementQuantity({{ $item['produk_id'] }})"
                            class="px-4 py-2 mr-2 border rounded-md"
                            wire:loading.attr="disabled">-</button>
                          <span class="w-8 text-center">{{ $item['quantity'] }}</span>
                          <button
                            wire:click="incrementQuantity({{ $item['produk_id'] }})"
                            class="px-4 py-2 ml-2 border rounded-md"
                            wire:loading.attr="disabled">+</button>
                        </div>
                      </td>
                      <td class="py-4">{{ $currency }}{{ number_format($item['total_amount'], 2) }}</td>
                      <td>
                        <button
                          wire:click="removeItem({{ $item['produk_id'] }})"
                          class="px-3 py-1 border-2 rounded-lg bg-slate-300 border-slate-400 hover:bg-red-500 hover:text-white hover:border-red-700"
                          wire:loading.attr="disabled"
                          wire:target="removeItem({{ $item['produk_id'] }})">
                          Remove
                        </button>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <div class="md:w-1/4">
              <div class="p-6 bg-white rounded-lg shadow-md">
                <h2 class="mb-4 text-lg font-semibold">Summary</h2>
                <div class="flex justify-between mb-2">
                  <span>Subtotal</span>
                  <span>{{ $currency }}{{ number_format($subtotal, 2) }}</span>
                </div>
                <div class="flex justify-between mb-2">
                  <span>Taxes</span>
                  <span>{{ $currency }}{{ number_format($tax, 2) }}</span>
                </div>
                <div class="flex justify-between mb-2">
                  <span>Shipping</span>
                  <span>{{ $currency }}{{ number_format($shipping, 2) }}</span>
                </div>
                <hr class="my-2">
                <div class="flex justify-between mb-2">
                  <span class="font-semibold">Total</span>
                  <span class="font-semibold">{{ $currency }}{{ number_format($total, 2) }}</span>
                </div>
                <button wire:click="checkout" class="w-full px-4 py-2 mt-4 text-white bg-blue-500 rounded-lg hover:bg-blue-600">Checkout</button>
              </div>
            </div>
          </div>
          @else
          <div class="p-8 text-center bg-white rounded-lg shadow-md">
            <h2 class="mb-4 text-xl font-semibold">Your cart is empty</h2>
            <p class="mb-6 text-gray-600">Looks like you haven't added any products to your cart yet.</p>
            <a href="{{ route('produk') }}" class="px-6 py-3 text-white bg-blue-500 rounded-lg hover:bg-blue-600">Continue Shopping</a>
          </div>
          @endif

          @if($message)
          <div class="p-4 mt-4 text-green-800 bg-green-100 rounded-lg">
            {{ $message }}
          </div>
          @endif
        </div>
      </div>
</div>
