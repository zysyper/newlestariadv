<?php

namespace App\Livewire\Pages;

use App\helper\AddToCart;
use App\Models\produk;
use Livewire\Component;

class ProductDetailPage extends Component
{
    public $slug;
    public $produk;
    public $relatedProducts;

    public $loadingCart = [];

    public function addToCart($product_id){
        $this->loadingCart[$product_id] = true;

        $product = produk::find($product_id);

        if (!$product) {
            $this->loadingCart[$product_id] = false;
            return;
        }
        AddToCart::addItemToCart($product_id);

        $total_count = count(AddToCart::getCartItemsFromCookie());

        // Dispatch event globally without specifying target component
        $this->dispatch('update-cart-count', total_count: $total_count);

        // Also dispatch a simple refresh event as backup
        $this->dispatch('refresh-navbar');

        $this->dispatch('add-to-cart', [
            'id' => $product_id,
            'name' => $product->name
        ]);

        $this->loadingCart[$product_id] = false;
    }

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->produk = produk::where('slug', $slug)->firstOrFail();

        // Load related products
        $this->loadRelatedProducts();
    }

    private function loadRelatedProducts()
    {
        // Get related products from the same category, excluding current product
        $this->relatedProducts = produk::where('kategori_id', $this->produk->kategori_id)
            ->where('id', '!=', $this->produk->id)
            ->active() // Use the scope from model
            ->inStock() // Use the scope from model
            ->with('kategori') // Load kategori relationship
            ->inRandomOrder()
            ->limit(4) // Limit to 4 products
            ->get();

        // If no related products from same category, get random products
        if ($this->relatedProducts->count() < 4) {
            $additionalProducts = produk::where('id', '!=', $this->produk->id)
                ->active()
                ->inStock()
                ->with('kategori')
                ->inRandomOrder()
                ->limit(4 - $this->relatedProducts->count())
                ->get();

            $this->relatedProducts = $this->relatedProducts->merge($additionalProducts);
        }
    }

    public function render()
    {
        return view('livewire.pages.product-detail-page', [
            'relatedProducts' => $this->relatedProducts
        ]);
    }
}
