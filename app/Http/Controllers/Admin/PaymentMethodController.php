<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{

    public function index()
{
    $paymentMethods = PaymentMethod::all();
    return view('admin.payment-methods.index', compact('paymentMethods'));
}

public function destroy(PaymentMethod $paymentMethod)
{
    $paymentMethod->delete();
    return redirect()->route('admin.payment-methods.index')
                     ->with('success', 'Payment method deleted successfully.');
}


    public function create()
    {
        return view('admin.payment-methods.create');
    }

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'account_name' => 'nullable|string|max:255',
        'account_number' => 'nullable|string|max:50',
        'bank_name' => 'nullable|string|max:255',
    ]);

    PaymentMethod::create([
        'name' => $request->name,
        'account_name' => $request->account_name,
        'account_number' => $request->account_number,
        'bank_name' => $request->bank_name,
        'status' => $request->status ?? 1,
    ]);

    return redirect()->route('admin.payment-methods.index')
                     ->with('success', 'Payment method created successfully.');
}


    public function edit(PaymentMethod $paymentMethod)
    {
        return view('admin.payment-methods.edit', compact('paymentMethod'));
    }

public function update(Request $request, PaymentMethod $paymentMethod)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'account_name' => 'nullable|string|max:255',
        'account_number' => 'nullable|string|max:50',
        'bank_name' => 'nullable|string|max:255',
    ]);

    $paymentMethod->update([
        'name' => $request->name,
        'account_name' => $request->account_name,
        'account_number' => $request->account_number,
        'bank_name' => $request->bank_name,
        'status' => $request->status ?? 1,
    ]);

    return redirect()->route('admin.payment-methods.index')
                     ->with('success', 'Payment method updated successfully.');
}

}
