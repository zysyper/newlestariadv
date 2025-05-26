<?php

namespace App\Livewire\Pages;

use App\Models\order;
use App\Models\orderitem;
use App\Models\produk;
use App\helper\AddToCart;
use App\helper\CartSynchronizer;
use App\Livewire\Partial\Navbar;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Reactive;

class CartPage extends Component
{
    public $cartItems = [];
    public $subtotal = 0;
    public $tax = 0;
    public $shipping = 0;
    public $total = 0;
    public $tax_rate = 0; // 10% tax
    public $message = '';
    public $currency = 'Rp.';

    protected $listeners = ['refreshCart' => 'loadCart'];

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $this->cartItems = AddToCart::getCartItemsFromCookie();
        $this->calculateTotals();
    }

    protected function calculateTotals()
    {
        $this->subtotal = AddToCart::calculateGrandTotal($this->cartItems);
        $this->tax = $this->subtotal * $this->tax_rate;
        $this->shipping = 0; // Set your shipping rate here
        $this->total = $this->subtotal + $this->tax + $this->shipping;
    }

    public function decrementQuantity($product_id)
    {
        foreach ($this->cartItems as $key => $item) {
            if ($item['produk_id'] == $product_id) {
                if ($item['quantity'] > 1) {
                    $this->cartItems[$key]['quantity']--;
                    $this->cartItems[$key]['total_amount'] = $this->cartItems[$key]['quantity'] * $this->cartItems[$key]['unit_amount'];
                    AddToCart::addCartItemsToCookie($this->cartItems);
                }
                break;
            }
        }

        $this->calculateTotals();
        $this->updateNavbar();
    }

    public function incrementQuantity($product_id)
    {
        foreach ($this->cartItems as $key => $item) {
            if ($item['produk_id'] == $product_id) {
                $this->cartItems[$key]['quantity']++;
                $this->cartItems[$key]['total_amount'] = $this->cartItems[$key]['quantity'] * $this->cartItems[$key]['unit_amount'];
                AddToCart::addCartItemsToCookie($this->cartItems);
                break;
            }
        }

        $this->calculateTotals();
        $this->updateNavbar();
    }

    public function removeItem($product_id)
    {
        foreach ($this->cartItems as $key => $item) {
            if ($item['produk_id'] == $product_id) {
                unset($this->cartItems[$key]);
                break;
            }
        }

        // Reindex array after removal
        $this->cartItems = array_values($this->cartItems);

        // Update cookie
        AddToCart::addCartItemsToCookie($this->cartItems);


        $this->calculateTotals();
        $this->updateNavbar();
    }

    protected function updateNavbar()
    {
        $this->dispatch('update-cart-count', total_count: count($this->cartItems))->to(Navbar::class);
    }

    public function checkout()
    {
        return redirect()->route('checkout');
    }

    public function getProductImageUrl($item)
    {
        $imageUrl = 'https://via.placeholder.com/150';

        if (isset($item['image'])) {
            if (is_string($item['image'])) {
                $imageUrl = asset('storage/' . $item['image']);
            } elseif (is_array($item['image']) && count($item['image']) > 0) {
                $imageUrl = asset('storage/' . $item['image'][0]);
            }
        }

        return $imageUrl;
    }

    public function render()
    {
        return view('livewire.pages.cart-page', [
            'hasItems' => count($this->cartItems) > 0
        ]);
    }
}
