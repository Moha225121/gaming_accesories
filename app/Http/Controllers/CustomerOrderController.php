<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class CustomerOrderController extends Controller
{
    /**
     * Display customer's order history.
     */
    public function index()
    {
        $orders = auth()->user()->orders()->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    /**
     * Display specific order details.
     */
    public function show(Order $order)
    {
        // Ensure the order belongs to the user
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load(['orderItems.product']);
        return view('orders.show', compact('order'));
    }
}
