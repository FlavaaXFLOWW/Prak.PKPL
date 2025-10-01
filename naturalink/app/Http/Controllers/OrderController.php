<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string',
            'customer_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);

        Order::create($validated);

        return back()->with('success', 'Order berhasil dikirim!');
    }
}
