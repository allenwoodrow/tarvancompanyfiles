@extends('layouts.app')

@section('content')
<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="container">   
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <h3>Order Confirmation</h3>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Order Confirmation</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>         
</div>
<!--breadcrumbs area end-->

<!-- Order Confirmation -->
<div class="Checkout_section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="confirmation-card text-center">
                    <div class="confirmation-icon">
                        <i class="fa fa-check-circle" style="font-size: 60px; color: #28a745;"></i>
                    </div>
                    <h2>Thank You For Your Order!</h2>
                    <p class="order-number">Order #: <strong>{{ $order->formatted_order_number }}</strong></p>
                    <p>We've sent a confirmation email to <strong>{{ Auth::user()->email }}</strong></p>
                    
                    <div class="order-details mt-4">
                        <h4>Order Details</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->items as $item)
                                        <tr>
                                            <td>{{ $item->product->name }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>${{ number_format($item->price, 2) }}</td>
                                            <td>${{ number_format($item->total, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-end"><strong>Subtotal:</strong></td>
                                        <td>${{ number_format($order->subtotal, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end"><strong>Shipping:</strong></td>
                                        <td>${{ number_format($order->shipping, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                        <td>${{ number_format($order->total, 2) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="shipping-info mt-4">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Shipping Address</h5>
                                @if(is_array($order->shipping_address))
                                    <address>
                                        <strong>{{ $order->shipping_address['first_name'] }} {{ $order->shipping_address['last_name'] }}</strong><br>
                                        {{ $order->shipping_address['address'] }}<br>
                                        @if(!empty($order->shipping_address['address2']))
                                            {{ $order->shipping_address['address2'] }}<br>
                                        @endif
                                        {{ $order->shipping_address['city'] }}, {{ $order->shipping_address['state'] }} {{ $order->shipping_address['zip_code'] }}<br>
                                        {{ $order->shipping_address['country'] }}<br>
                                        <i class="fa fa-phone"></i> {{ $order->shipping_address['phone'] }}<br>
                                        <i class="fa fa-envelope"></i> {{ $order->shipping_address['email'] }}
                                    </address>
                                @else
                                    <p>{{ $order->shipping_address ?: 'Shipping address not available.' }}</p>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <h5>Billing Address</h5>
                                @if(is_array($order->billing_address))
                                    <address>
                                        <strong>{{ $order->billing_address['first_name'] }} {{ $order->billing_address['last_name'] }}</strong><br>
                                        {{ $order->billing_address['address'] }}<br>
                                        @if(!empty($order->billing_address['address2']))
                                            {{ $order->billing_address['address2'] }}<br>
                                        @endif
                                        {{ $order->billing_address['city'] }}, {{ $order->billing_address['state'] }} {{ $order->billing_address['zip_code'] }}<br>
                                        {{ $order->billing_address['country'] }}<br>
                                        <i class="fa fa-phone"></i> {{ $order->billing_address['phone'] }}<br>
                                        <i class="fa fa-envelope"></i> {{ $order->billing_address['email'] }}
                                    </address>
                                @else
                                    <p>{{ $order->billing_address ?: 'Billing address not available.' }}</p>
                                @endif
                                
                                <br>
                                <h5>Payment Method</h5>
                                <p>{{ $order->payment_method }}</p>
                                <p><strong>Status:</strong> <span class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'pending' ? 'warning' : 'secondary') }}">{{ ucfirst($order->status) }}</span></p>
                            </div>
                        </div>
                    </div>

                    <div class="action-buttons mt-4">
                        <a href="{{ route('home') }}" class="btn btn-primary">Continue Shopping</a>
                        <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary">View Order History</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .confirmation-card {
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }
    .confirmation-icon {
        margin-bottom: 20px;
    }
    .order-number {
        font-size: 18px;
        color: #666;
    }
    .table th {
        background-color: #f8f9fa;
    }
    address {
        font-style: normal;
        line-height: 1.6;
    }
    .badge {
        font-size: 0.8em;
    }
</style>
@endsection