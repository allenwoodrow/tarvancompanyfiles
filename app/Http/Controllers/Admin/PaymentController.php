<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('order.user')->latest()->get();
        return view('admin.payments.index', compact('payments'));
    }

    public function create()
    {
        $orders = Order::with('user')->get();
        return view('admin.payments.create', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'amount'   => 'required|numeric|min:0',
            'method'   => 'required|string|max:255',
            'status'   => 'required|string|max:255',
        ]);

        Payment::create($request->only(['order_id', 'amount', 'method', 'status']));

        return redirect()->route('admin.payments.index')->with('success', 'Payment recorded successfully!');
    }

    public function edit(Payment $payment)
    {
        $orders = Order::with('user')->get();
        return view('admin.payments.edit', compact('payment', 'orders'));
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'amount'   => 'required|numeric|min:0',
            'method'   => 'required|string|max:255',
            'status'   => 'required|string|max:255',
        ]);

        $payment->update($request->only(['order_id', 'amount', 'method', 'status']));

        return redirect()->route('admin.payments.index')->with('success', 'Payment updated successfully!');
    }


    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('admin.payments.index')->with('success', 'Payment deleted successfully!');
    }
}
