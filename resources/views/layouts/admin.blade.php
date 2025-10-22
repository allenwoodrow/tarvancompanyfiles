<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Fashion Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="bg-dark text-white p-3" style="width: 220px; min-height: 100vh;">
            <h3 class="mb-4">Admin</h3>
            <nav class="nav flex-column">
                <a href="{{ route('admin.dashboard') }}" class="nav-link text-white">🏠 Dashboard</a>
                <a href="{{ route('admin.products.index') }}" class="nav-link text-white">🛍 Products</a>
                <a href="{{ route('admin.users.index') }}" class="nav-link text-white">👤 Users</a>
                <a href="{{ route('admin.orders.index') }}" class="nav-link text-white">📦 Orders</a>
                <a href="{{ route('admin.payments.index') }}" class="nav-link text-white">💳 Payments</a>
                <a href="{{ route('admin.payment-methods.index') }}" class="nav-link text-white">⚡ Payment Methods</a>
            </nav>
        </div>


        <!-- Main Content -->
        <div class="flex-grow-1 p-4">
            @yield('content')
        </div>
    </div>
</body>
</html>
