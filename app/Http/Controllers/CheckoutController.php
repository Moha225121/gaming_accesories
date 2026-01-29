<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Show the checkout page.
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('shop.index')->with('error', 'Your cart is empty.');
        }

        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('checkout.index', compact('cart', 'total'));
    }

    /**
     * Process the order.
     */
    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('shop.index')->with('error', 'Your cart is empty.');
        }

        $validated = $request->validate([
            'phone' => 'required|string|max:20',
            'shipping_address' => 'required|string',
            'payment_method' => 'required|in:cash_on_delivery,pay_on_pickup',
            'notes' => 'nullable|string',
        ]);

        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        try {
            DB::beginTransaction();

            $order = Order::create([
                'user_id' => auth()->id(),
                'total_amount' => $total,
                'status' => Order::STATUS_PENDING,
                'payment_method' => $request->payment_method,
                'shipping_address' => $request->shipping_address,
                'phone' => $request->phone,
                'notes' => $request->notes,
            ]);

            foreach ($cart as $id => $details) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'quantity' => $details['quantity'],
                    'price' => $details['price'],
                ]);

                // Update stock quantity
                $product = Product::find($id);
                if ($product) {
                    $product->decrement('stock_quantity', $details['quantity']);
                }
            }

            DB::commit();

            // Clear cart
            session()->forget('cart');

            return redirect()->route('checkout.success', $order->id);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Show success page.
     */
    public function success(Order $order)
    {
        // Ensure the order belongs to the user
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('checkout.success', compact('order'));
    }
}
