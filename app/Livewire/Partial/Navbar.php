<?php

namespace App\Livewire\Partial;

use App\helper\AddToCart;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cookie;

class Navbar extends Component
{
    public string | int | array $total_count = 0;

    public function mount(): void
    {
        // Just get the cart count directly
        $this->total_count = count(AddToCart::getCartItemsFromCookie());
    }

    #[On('update-cart-count')]
    public function updateCartCount($total_count): void
    {
        $this->total_count = $total_count;
    }

    // Add this refreshCartCount method
    #[On('refresh-navbar')]
    public function refreshCartCount(): void
    {
        $this->total_count = count(AddToCart::getCartItemsFromCookie());
    }

    public function render()
    {
        return view('livewire.partial.navbar');
    }
}

