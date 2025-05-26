<?php

namespace App\Livewire\Pages;

use App\helper\AddToCart;
use App\Models\produk;
use App\Models\kategori;
use Livewire\Component;
use Livewire\WithPagination;

class ProdukPage extends Component
{
    use WithPagination;

    // Filters
    public $categories = [];
    public $inStock = false;
    public $onSale = false;
    public $featured = false;
    public $maxPrice = 2000000;

    // Search
    public $search = '';

    // Sorting and pagination
    public $sortBy = 'latest';
    public $perPage = 6;
    public $viewMode = 'grid';

    // UI state
    public $loadingCart = [];
    public $showFilters = false;

    protected $queryString = [
        'categories' => ['except' => []],
        'inStock' => ['except' => false],
        'onSale' => ['except' => false],
        'featured' => ['except' => false],
        'maxPrice' => ['except' => 2000000],
        'sortBy' => ['except' => 'latest'],
        'perPage' => ['except' => 6],
        'viewMode' => ['except' => 'grid'],
        'search' => ['except' => ''],
    ];

     public function addToCart($product_id)
    {
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

    /**
     * Reset all filters to default values
     *
     * @return void
     */
    public function resetFilters()
    {
        $this->categories = [];
        $this->inStock = false;
        $this->onSale = false;
        $this->featured = false;
        $this->maxPrice = 2000000;
        $this->search = '';
        $this->sortBy = 'latest';
        $this->resetPage();
    }

    /**
     * Reset page when filters are updated
     *
     * @param string $property
     * @return void
     */
    public function updated($property)
    {
        if (in_array($property, ['search', 'categories', 'inStock', 'onSale', 'featured', 'maxPrice', 'sortBy', 'perPage'])) {
            $this->resetPage();
        }
    }

    /**
     * Toggle mobile filters visibility
     *
     * @return void
     */
    public function toggleFilters()
    {
        $this->showFilters = !$this->showFilters;
    }

    /**
     * Render the component
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $produkQuery = produk::query()->where('is_active', 1);

        // Apply search filter
        if (!empty($this->search)) {
            $produkQuery->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $this->search . '%');
            });
        }

        // Apply category filter
        if (!empty($this->categories)) {
            $produkQuery->whereIn('kategori_id', $this->categories);
        }

        // Apply other filters
        if ($this->inStock) {
            $produkQuery->where('in_stock', true);
        }

        if ($this->onSale) {
            $produkQuery->where('on_sale', true);
        }

        if ($this->featured) {
            $produkQuery->where('is_featured', true);
        }

        // Apply price filter
        $produkQuery->where('harga', '<=', $this->maxPrice);

        // Apply sorting
        switch ($this->sortBy) {
            case 'price-asc':
                $produkQuery->orderBy('harga', 'asc');
                break;
            case 'price-desc':
                $produkQuery->orderBy('harga', 'desc');
                break;
            case 'name':
                $produkQuery->orderBy('name', 'asc');
                break;
            case 'latest':
            default:
                $produkQuery->latest();
                break;
        }

        // Get categories with counts
        $kategoris = kategori::withCount('produks')->get();

        return view('livewire.pages.produk-page', [
            'produks' => $produkQuery->paginate($this->perPage),
            'kategoris' => $kategoris,
        ]);
    }
}
