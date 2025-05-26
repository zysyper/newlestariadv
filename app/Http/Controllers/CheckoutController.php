<?php

namespace App\Http\Controllers;

use App\helper\AddToCart;
use App\Mail\OrderSuccess;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page
     */
    public function index()
    {
        $cart_items = AddToCart::getCartItemsFromCookie();
        $grand_total = AddToCart::calculateGrandTotal($cart_items);

        return view('pages.checkout', [
            'cart_items' => $cart_items,
            'grand_total' => $grand_total,
        ]);
    }

    /**
     * Process the order placement
     */
    public function placeOrder(Request $request)
    {
        // Validasi input
        $request->validate([
            'first_name'      => 'required|string|max:255',
            'last_name'       => 'required|string|max:255',
            'phone'           => 'required|string|max:20',
            'payment_method'  => 'required|string',
            'file'            => 'required|file|max:5120', // 5MB max
            'catatan'         => 'nullable|string|max:1000',
        ]);

        // Ambil data keranjang
        $cart_items = AddToCart::getCartItemsFromCookie();

        // Cek apakah keranjang tidak kosong
        if (empty($cart_items)) {
            return redirect()->back()->with('error', 'Keranjang belanja kosong.');
        }

        // Siapkan line items jika diperlukan untuk pembayaran
        $line_items = [];
        foreach ($cart_items as $item) {
            $line_items[] = [
                'price_data' => [
                    'currency' => 'IDR',
                    'unit_amount' => $item['unit_amount'] * 100,
                    'product_data' => [
                        'name' => $item['name'],
                    ],
                ],
                'quantity' => $item['quantity'],
            ];
        }

        // Handle file upload
        $file_path = null;
        $original_name = null;
        $mime_type = null;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $file_path = $file->store('uploads', 'public');
            $original_name = $file->getClientOriginalName();
            $mime_type = $file->getMimeType();
        }

        // Buat order baru
        $order = new Order();
        $order->user_id = Auth::id();
        $order->grand_total = AddToCart::calculateGrandTotal($cart_items);
        $order->payment_method = $request->payment_method;
        $order->payment_status = 'pending';
        $order->status = 'new';
        $order->currency = 'IDR';
        $order->notes = $request->first_name .' '. $request->last_name;
        $order->catatan = $request->catatan ?? '';
        $order->phone = $request->phone;

        // Simpan informasi file jika ada
        if ($file_path) {
            $order->original_name = $original_name;
            $order->file_path = $file_path;
            $order->mime_type = $mime_type;
        }

        // Simpan order dan item-nya
        $order->save();
        $order->items()->createMany($cart_items);

        // Bersihkan keranjang
        AddToCart::clearCartItems();

        // Mengirim Email

        Mail::to(request()->user())->send(new OrderSuccess($order));

        // Redirect ke halaman sukses dengan order ID
        return redirect()->route('checkout.success', ['order' => $order->id])
                        ->with('success', 'Pesanan berhasil dibuat!');
    }

    /**
     * Display the success page
     */
    public function success($orderId = null)
    {
        // Jika order ID tidak diberikan, ambil order terbaru dari user
        if ($orderId) {
            $order = Order::where('user_id', Auth::id())
                         ->where('id', $orderId)
                         ->first();
        } else {
            $order = Order::where('user_id', Auth::id())
                         ->latest()
                         ->first();
        }

        // Jika tidak ada order, redirect ke home
        if (!$order) {
            return redirect()->route('home')
                           ->with('error', 'Order tidak ditemukan.');
        }

        // Get user details
        $user = User::find(Auth::id());

        return view('pages.succes-page', [
            'order' => $order,
            'user' => $user,
        ]);
    }

    /**
     * Show order details
     */
    public function show($orderId)
    {
        $order = Order::where('user_id', Auth::id())
                     ->where('id', $orderId)
                     ->with('items')
                     ->first();

        if (!$order) {
            return redirect()->route('home')
                           ->with('error', 'Order tidak ditemukan.');
        }

        return view('order-detail', compact('order'));
    }
}
