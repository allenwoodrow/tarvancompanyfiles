@extends('layouts.app')

@section('content')

<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="container">   
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <h3>My account</h3>
                    <ul>
                        <li><a href="{{ route('home') }}">home</a></li>
                        <li>My account</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>         
</div>
<!--breadcrumbs area end-->

<!-- my account start  -->
<section class="main_content_area">
    <div class="container">   
        <div class="account_dashboard">
            <div class="row">
                <div class="col-sm-12 col-md-3 col-lg-3">
                    <!-- Nav tabs -->
                    <div class="dashboard_tab_button">
                        <ul role="tablist" class="nav flex-column dashboard-list">
                            <li><a href="#dashboard" data-bs-toggle="tab" class="nav-link active">Dashboard</a></li>
                            <li> <a href="#orders" data-bs-toggle="tab" class="nav-link">Orders</a></li>
                            <li><a href="#address" data-bs-toggle="tab" class="nav-link">Addresses</a></li>
                            <li><a href="#account-details" data-bs-toggle="tab" class="nav-link">Account details</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}" class="nav-link" 
                                       onclick="event.preventDefault(); this.closest('form').submit();">
                                        logout
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>    
                </div>
                <div class="col-sm-12 col-md-9 col-lg-9">
                    <!-- Tab panes -->
                    <div class="tab-content dashboard_content">
                        <div class="tab-pane fade show active" id="dashboard">
                            <h3>Dashboard</h3>
                            <p>From your account dashboard. you can easily check &amp; view your <a href="#orders">recent orders</a>, manage your <a href="#address">shipping and billing addresses</a> and <a href="#account-details">Edit your password and account details.</a></p>
                            
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Account Information</h5>
                                            <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                                            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                                            <p><strong>Phone:</strong> {{ Auth::user()->phone ?? 'Not provided' }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Recent Activity</h5>
                                            <p>Member since: {{ Auth::user()->created_at->format('M d, Y') }}</p>
                                            <p>Last login: {{ Auth::user()->last_login_at ? Auth::user()->last_login_at->format('M d, Y H:i') : 'N/A' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-pane fade" id="orders">
                            <h3>Orders</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Order #</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($orders as $order)
                                            <tr>
                                                <td>{{ $order->order_number }}</td>
                                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'pending' ? 'warning' : 'secondary') }}">
                                                        {{ ucfirst($order->status) }}
                                                    </span>
                                                </td>
                                                <td>${{ number_format($order->total, 2) }}</td>
                                                <td><a href="{{ route('order.confirmation', $order->id) }}" class="view">view</a></td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No orders found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="tab-pane fade" id="address">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="billing-address">Billing address</h4>
                                    @if(Auth::user()->primary_address)
                                        <p>{{ Auth::user()->primary_address }}</p>
                                        <p>Phone: {{ Auth::user()->phone ?? 'Not provided' }}</p>
                                    @else
                                        <p>No billing address saved.</p>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <h4 class="shipping-address">Shipping address</h4>
                                    @if(Auth::user()->secondary_address)
                                        <p>{{ Auth::user()->secondary_address }}</p>
                                    @else
                                        <p>No shipping address saved.</p>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('checkout.index') }}?save_address=true" class="btn btn-primary">
                                    Update Addresses
                                </a>
                            </div>
                        </div>
                        
                        <div class="tab-pane fade" id="account-details">
                            <h3>Account details</h3>
                            <div class="login">
                                <div class="login_form_container">
                                    <div class="account_login_form">
                                        <!-- Profile Update Form -->
                                        @include('profile.partials.update-profile-information-form')
                                        
                                        <hr>
                                        
                                        <!-- Password Update Form -->
                                        @include('profile.partials.update-password-form')
                                        
                                        <hr>
                                        
                                        <!-- Delete Account Form -->
                                        @include('profile.partials.delete-user-form')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>        	
</section>			
<!-- my account end   --> 

@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Activate tab based on URL hash
    const hash = window.location.hash;
    if (hash) {
        const tab = document.querySelector(`a[href="${hash}"]`);
        if (tab) {
            tab.click();
        }
    }
    
    // Handle form submissions with custom styling
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const button = this.querySelector('button[type="submit"]');
            if (button) {
                button.disabled = true;
                button.innerHTML = 'Processing...';
            }
        });
    });
});
</script>
@endsection