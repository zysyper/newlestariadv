<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class MyOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Menampilkan daftar pesanan user
    public function index()
    {
        $my_orders = Order::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('pages.myorder', [
            'orders' => $my_orders,
        ]);
    }

    public function payment($order_id)
    {
        $order = Order::where('id', $order_id)
            ->where('user_id', auth()->id())
            ->first(); // Changed from get() to first()

        // Add error handling
        if (!$order) {
            abort(404, 'Order not found');
        }

        return view('pages.payment', compact('order'));
    }


    // Menampilkan detail pesanan
    public function show($order_id)
    {
        $user = User::find(auth()->user()->id);

        // Load order dengan security check
        $order = Order::where('id', $order_id)
            ->where('user_id', auth()->id()) // Security: pastikan order milik user yang login
            ->firstOrFail();

        // Load order items
        $order_items = OrderItem::with('produk')
            ->where('order_id', $order_id)
            ->get();

        return view('pages.myorder-detail', [
            'order' => $order,
            'order_items' => $order_items,
            'user' => $user
        ]);
    }


    public function cancel(Request $request, Order $order)
    {
        try {
            // Check if the order belongs to the authenticated user
            if ($order->user_id !== Auth::id()) {
                return redirect()->route('my-orders')
                    ->with('error', 'You are not authorized to cancel this order.');
            }

            // Check if the order can be cancelled (only 'new' status orders)
            if ($order->status !== 'new') {
                return redirect()->route('my-orders')
                    ->with('error', 'This order cannot be cancelled. Current status: ' . ucfirst($order->status));
            }

            if ($order->payment_status !== 'pending') {
                return redirect()->route('my-orders')
                    ->with('error', 'This order cannot be cancelled. Current status: ' . ucfirst($order->payment_status));
            }

            // Begin database transaction
            DB::beginTransaction();

            // Update order status to cancelled
            $order->update([
                'payment_status' => 'failed',
                'status' => 'canceled',
                'canceled_at' => now(),
                'canceled_by' => Auth::id(),
                'cancellation_reason' => 'Cancelled by customer'
            ]);


            DB::commit();

            return redirect()->route('my-orders')
                ->with('success', 'Order has been cancelled successfully.');

        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->route('my-orders')
                ->with('error', 'Failed to cancel order. Please try again or contact support.');
        }
    }

}
