<?php

namespace App\helper;

use Illuminate\Support\Facades\Cookie;
use App\Models\produk;
use Illuminate\Support\Facades\Cache;

class AddToCart {
    static public function addItemToCart($product_id) {
        $cart_items = self::getCartItemsFromCookie();
        $existing_item = null;

        // Check if item already exists in cart
        foreach ($cart_items as $key => $item) {
            if ($item['produk_id'] == $product_id) {
                $existing_item = $key;
                break;
            }
        }

        if ($existing_item !== null) {
            $cart_items[$existing_item]['quantity']++;
            $cart_items[$existing_item]['total_amount'] = $cart_items[$existing_item]['quantity'] *
                $cart_items[$existing_item]['unit_amount'];
        } else {
            $product = produk::where('id', $product_id)->first(['id', 'name', 'harga', 'images']);
            if ($product) {
                $cart_items[] = [
                    'produk_id' => $product_id,
                    'name' => $product->name,
                    'image' => $product->images[0],
                    'quantity' => 1,
                    'unit_amount' => $product->harga,
                    'total_amount' => $product->harga
                ];
            }
        }

        self::addCartItemsToCookie($cart_items);
        return count($cart_items);
    }

     static public function addItemToCartQty($product_id , $qty = 1) {
        $cart_items = self::getCartItemsFromCookie();
        $existing_item = null;

        // Check if item already exists in cart
        foreach ($cart_items as $key => $item) {
            if ($item['produk_id'] == $product_id) {
                $existing_item = $key;
                break;
            }
        }

        if ($existing_item !== null) {
            $cart_items[$existing_item]['quantity'] = $qty;
            $cart_items[$existing_item]['total_amount'] = $cart_items[$existing_item]['quantity'] *
                $cart_items[$existing_item]['unit_amount'];
        } else {
            $product = produk::where('id', $product_id)->first(['id', 'name', 'harga', 'images']);
            if ($product) {
                $cart_items[] = [
                    'produk_id' => $product_id,
                    'name' => $product->name,
                    'image' => $product->images[0],
                    'quantity' => 1,
                    'unit_amount' => $product->harga,
                    'total_amount' => $product->harga
                ];
            }
        }

        self::addCartItemsToCookie($cart_items);
        return count($cart_items);
    }

    static public function removeCartItem($product_id) {
        $cart_items = self::getCartItemsFromCookie();
        foreach ($cart_items as $key => $item) {
            if ($item['produk_id'] == $product_id) {
                unset($cart_items[$key]);
            }
        }
        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }

    // Add cart items to cookie
    static public function addCartItemsToCookie($cart_items) {
        Cookie::queue('cart_items', json_encode($cart_items), 60 * 24 * 30);
    }

    // Clear cart items from cookie
    static public function clearCartItems() {
        Cookie::queue(Cookie::forget('cart_items'));
    }

    // Get all cart items from cookie
    static public function getCartItemsFromCookie() {
        $cart_items = json_decode(Cookie::get('cart_items'), true);
        if (!$cart_items) {
            $cart_items = [];
        }
        return $cart_items;
    }

    // Increment item quantity
    static public function incrementQuantityToCartItem($product_id) {
        $cart_items = self::getCartItemsFromCookie();
        foreach ($cart_items as $key => $item) {
            if ($item['produk_id'] == $product_id) {
                $cart_items[$key]['quantity']++;
                $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * $cart_items[$key]['unit_amount'];
            }
        }
        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }

    // Calculate grand total
    static public function calculateGrandTotal($items) {
        return array_sum(array_column($items, 'total_amount'));
    }
}
