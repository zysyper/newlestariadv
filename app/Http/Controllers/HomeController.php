<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * Display the home page with products
     */
    public function index(Request $request): View
    {
        $perPage = 8;
        $sortField = $request->get('sortField', 'created_at');
        $sortDirection = $request->get('sortDirection', 'desc');

        // Validate sort direction
        $sortDirection = in_array($sortDirection, ['asc', 'desc']) ? $sortDirection : 'desc';

        // Get active categories
        $kategoris = Kategori::where('is_active', 1)->get();

        // Get products with search and sorting
        $produks = Produk::where('is_active', true)
            ->orderBy($sortField, $sortDirection)
            ->paginate($perPage);

        // Append query parameters to pagination links
        $produks->appends($request->query());

        return view('pages.home', [
            'kategoris' => $kategoris,
            'produks' => $produks,
        ]);
    }

    /**
     * Display the categories page
     */
    public function kategori(): View
    {
        $kategoris = Kategori::where('is_active', 1)->get();

        return view('pages.kategori', [
            'kategoris' => $kategoris,
        ]);
    }

}
