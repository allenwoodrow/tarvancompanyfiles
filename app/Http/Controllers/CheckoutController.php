<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Rinvex\Country\CountryLoader;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to proceed to checkout');
        }

        // Get user's cart
        $cart = Cart::getCart($request);
        $cart->load('items.product');

        // Check if cart is empty
        if ($cart->items->count() === 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        // Get available payment methods - FIXED QUERY
        $paymentMethods = PaymentMethod::where('status', '1')->get();

        // // Debug: Check what payment methods are retrieved
        // \Log::info('Payment methods:', $paymentMethods->toArray());
        // // Or use dd() for immediate debugging:
        // // dd($paymentMethods);

        

        $countries = CountryLoader::countries(); // returns array like ['US' => 'United States', 'GB' => 'United Kingdom', ...]

        return view('checkout.index', compact('cart', 'paymentMethods', 'countries'));
    }

    public function process(Request $request)
    {
        // Validate request
        $request->validate([
            'billing_first_name' => 'required|string|max:255',
            'billing_last_name' => 'required|string|max:255',
            'billing_email' => 'required|email|max:255',
            'billing_phone' => 'required|string|max:20',
            'billing_address' => 'required|string|max:500',
            'billing_city' => 'required|string|max:255',
            'billing_state' => 'required|string|max:255',
            'billing_country' => 'required|string|max:255',
            'billing_zip_code' => 'required|string|max:20',
            'shipping_first_name' => 'nullable|string|max:255',
            'shipping_last_name' => 'nullable|string|max:255',
            'shipping_email' => 'nullable|email|max:255',
            'shipping_phone' => 'nullable|string|max:20',
            'shipping_address' => 'nullable|string|max:500',
            'shipping_city' => 'nullable|string|max:255',
            'shipping_state' => 'nullable|string|max:255',
            'shipping_country' => 'nullable|string|max:255',
            'shipping_zip_code' => 'nullable|string|max:20',
            'payment_method' => 'required|exists:payment_methods,id',
            'save_shipping' => 'nullable|boolean',
            'notes' => 'nullable|string|max:1000'
        ]);

        DB::beginTransaction();

        try {
            // Get user's cart
            $cart = Cart::getCart($request);
            $cart->load('items.product');

            // Check if cart is empty
            if ($cart->items->count() === 0) {
                return redirect()->route('cart.index')->with('error', 'Your cart is empty');
            }

            // Get payment method
            $paymentMethod = PaymentMethod::findOrFail($request->payment_method);

            // Update user's phone and address if requested
            $user = Auth::user();
            if ($request->save_shipping) {
                $user->update([
                    'phone' => $request->billing_phone,
                    'primary_address' => $this->formatAddress($request->all(), 'billing')
                ]);
            }

            // Create order - UPDATED TO MATCH YOUR DB STRUCTURE
            // $order = Order::create([
            //     'user_id' => Auth::id(),
            //     'order_id' => 'ORD-' . strtoupper(uniqid()), // This should probably be 'order_number' if that's your column name
            //     'status' => 'pending',
            //     'total_amount' => $cart->total, // Use total_amount instead of total
            //     'shipping_address' => $this->formatAddress($request->all(), 'billing'), // Use string format for address
            //     'billing_address' => $request->different_shipping ? 
            //         $this->formatAddress($request->all(), 'shipping') : 
            //         $this->formatAddress($request->all(), 'billing'),
            //     'payment_method' => $paymentMethod->name,
            //     'notes' => $request->notes
            // ]);

            // In the process method:
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => strtoupper(uniqid()), // Store without ORD- prefix
                'status' => 'pending',
                'subtotal' => $cart->subtotal,
                'shipping' => $cart->shipping,
                'total' => $cart->total,
                'billing_address' => $this->formatAddress($request->all(), 'billing'),
                'shipping_address' => $request->different_shipping ? 
                    $this->formatAddress($request->all(), 'shipping') : 
                    $this->formatAddress($request->all(), 'billing'),
                'payment_method' => $paymentMethod->name,
                'notes' => $request->notes
            ]);

            // Create order items
            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'size' => $item->size,
                    'color' => $item->color,
                    'total' => $item->price * $item->quantity
                ]);
            }

            // Create payment record
            Payment::create([
                'order_id' => $order->id,
                'amount' => $cart->total,
                'method' => $paymentMethod->name,
                'status' => 'pending'
            ]);

            // Clear the cart
            $cart->items()->delete();
            $cart->updateTotals();

            DB::commit();

            // Redirect to order confirmation page
            return redirect()->route('order.confirmation', $order->id)
                ->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error processing order: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Format address for storage
     */
    // In your CheckoutController process method
    // private function formatAddress($data, $type)
    // {
    //     $address = [
    //         'first_name' => $data[$type . '_first_name'],
    //         'last_name' => $data[$type . '_last_name'],
    //         'email' => $data[$type . '_email'],
    //         'phone' => $data[$type . '_phone'],
    //         'address' => $data[$type . '_address'],
    //         'address2' => $data[$type . '_address2'] ?? '',
    //         'city' => $data[$type . '_city'],
    //         'state' => $data[$type . '_state'],
    //         'country' => $data[$type . '_country'],
    //         'zip_code' => $data[$type . '_zip_code']
    //     ];

    //     return json_encode($address);
    // }

    // In CheckoutController - Alternative formatAddress method
    private function formatAddress($data, $type)
    {
        $firstName = $data[$type . '_first_name'];
        $lastName = $data[$type . '_last_name'];
        $address = $data[$type . '_address'];
        $city = $data[$type . '_city'];
        $state = $data[$type . '_state'];
        $country = $data[$type . '_country'];
        $zipCode = $data[$type . '_zip_code'];
        
        return "{$firstName} {$lastName}, {$address}, {$city}, {$state}, {$country} {$zipCode}";
    }


    public function confirmation($orderId)
    {
        $order = Order::with(['items.product'])
            ->where('user_id', Auth::id())
            ->findOrFail($orderId);

        // Decode JSON addresses to arrays
        // $order->shipping_address = json_decode($order->shipping_address, true);
        // $order->billing_address = json_decode($order->billing_address, true);

        return view('checkout.confirmation', compact('order'));
    }

    
}