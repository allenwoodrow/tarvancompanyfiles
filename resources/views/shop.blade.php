@extends('layouts.app')

@section('content')

<!-- breadcrumb start -->
<div class="roister-breadcrumb-section" data-background="{{ asset('assets/images/bg/breadcrumb-bg.png') }}">
  <div class="container position-relative z-3">
    <h1 class="breadcrumb-title mb-40 wow fadeInUp">Shop Page</h1>
    <ul class="breadcrumb-list wow fadeInUp" data-wow-delay=".2s">
      <li><a href="{{ route('home') }}">Home</a></li>
      <li class="active">Shop Page</li>
    </ul>
  </div>
</div>
<!-- breadcrumb end -->

<!-- best dishes section start -->
<section class="roister-best-dishes-section py-120">
  <!-- shapes -->
  <img class="shape-1" src="{{ asset('assets/images/shapes/dish-shape-1.png') }}" alt="img">
  <img class="shape-2" src="{{ asset('assets/images/shapes/dish-shape-2.png') }}" alt="img">
  <img class="shape-3 item-bounce" src="{{ asset('assets/images/shapes/dish-shape-3.png') }}" alt="img">
  <img class="shape-4" src="{{ asset('assets/images/shapes/dish-shape-4.png') }}" alt="img">

  <div class="container">

    <!-- Header Section -->
    <div class="row justify-content-center">
      <div class="col-lg-7 text-center">
        <h2 class="section-title mb-18 wow fadeInUp">Our Best Seller Dishes</h2>
        <p class="des mb-50 wow fadeInUp" data-wow-delay=".2s">
          Explore our delicious Nigerian meals — from Jollof Rice to Egusi Soup and Zobo drinks, all freshly prepared.
        </p>
      </div>
    </div>

    <!-- Filter Row -->
    <div class="row justify-content-center mb-5">
      <div class="col-md-10">
        <form method="GET" action="{{ route('shop') }}" class="d-flex flex-wrap justify-content-center gap-3">
          <input type="text" name="search" class="form-control w-auto" placeholder="Search meals..." value="{{ request('search') }}">

          <select name="category" class="form-select w-auto">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
              <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                {{ ucfirst($cat) }}
              </option>
            @endforeach
          </select>

          <select name="sort" class="form-select w-auto">
            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
          </select>

          <button type="submit" class="primary-btn border-radius-6">Filter</button>
        </form>
      </div>
    </div>

    <!-- Products Grid -->
    <div class="row gy-4">
      @forelse ($products as $product)
        <div class="col-12 col-md-6 col-lg-4 wow fadeInUp" data-wow-delay=".2s">
          <div class="roister-single-dish">
            <div class="img-wraper">
              <a href="{{ route('shop.show', $product->id) }}">
                <img src="{{ asset($product->image ?? 'assets/images/placeholder.jpg') }}" alt="{{ $product->name }}">
              </a>
            </div>
            <div class="content-wraper">
              <div class="top-area mb-24">
                <h5 class="title">
                  <a href="{{ route('shop.show', $product->id) }}">{{ $product->name }}</a>
                </h5>

                <!-- Add to Cart -->
                <form action="{{ route('cart.add') }}" method="POST" class="d-inline add-to-cart-form">
                  @csrf
                  <input type="hidden" name="product_id" value="{{ $product->id }}">
                  <button type="submit" class="primary-btn md border-radius-25">Buy Now</button>
                </form>
              </div>

              <div class="btm-area">
                <div class="rating-wraper text-warning">
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star-half-alt"></i>
                </div>
                <h4 class="price text-success">₦{{ number_format($product->price, 0) }}</h4>
              </div>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12 text-center">
          <p class="text-muted">No meals found for your search or filter.</p>
        </div>
      @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-5">
      {{ $products->links('pagination::bootstrap-5') }}
    </div>

  </div>
</section>
<!-- best dishes section end -->


<!-- newsletter section start -->
<div class="roister-newsletter-area">
  <div class="cta-card">
    <h4 class="mb-20 wow fadeInUp" data-wow-delay=".2s">Join the Restaurant</h4>
    <a href="{{ route('register') }}" class="primary-btn border-radius-6 mb-50 wow fadeInUp" data-wow-delay=".3s">Register Now
      <svg width="7" height="11" viewBox="0 0 7 11" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M6.34375 5.78125L1.78125 10.4062C1.625 10.5625 1.375 10.5625 1.25 10.4062L0.625 9.78125C0.46875 9.625 0.46875 9.40625 0.625 9.25L4.3125 5.5L0.625 1.78125C0.46875 1.625 0.46875 1.375 0.625 1.25L1.25 0.625C1.375 0.46875 1.625 0.46875 1.78125 0.625L6.34375 5.25C6.5 5.40625 6.5 5.625 6.34375 5.78125Z" fill="white" />
      </svg>
    </a>

    <div class="reveal-img">
      <img class="news-letter-img" src="{{ asset('assets/images/news-img-1.png') }}" alt="img">
    </div>
  </div>

  <div class="cta-calling-card wow fadeIn" data-wow-delay=".2s">
    <h3 class="title mb-30 wow fadeInUp" data-wow-delay=".3s">you are one
      step from
      life</h3>
    <h5 class="subtitle wow fadeInUp" data-wow-delay=".4s">Erin Miller</h5>
  </div>

  <div class="main-news-letter-card wow fadeInUp" data-wow-delay=".3s">
    <div class="reveal-img">
      <img class="main-img mb-30" src="{{ asset('assets/images/news-img-2.png') }}" alt="img">
    </div>
    <div class="btm-area wow fadeInUp" data-wow-delay=".2s">
      <h4 class="title">Subscribe to Our Newsletter</h4>
      <form class="form-wraper">
        <input type="text" placeholder="Enter Your Email">
        <button type="button" class="primary-btn border-radius-6 mb-50">Subscribe
          <svg width="7" height="11" viewBox="0 0 7 11" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M6.34375 5.78125L1.78125 10.4062C1.625 10.5625 1.375 10.5625 1.25 10.4062L0.625 9.78125C0.46875 9.625 0.46875 9.40625 0.625 9.25L4.3125 5.5L0.625 1.78125C0.46875 1.625 0.46875 1.375 0.625 1.25L1.25 0.625C1.375 0.46875 1.625 0.46875 1.78125 0.625L6.34375 5.25C6.5 5.40625 6.5 5.625 6.34375 5.78125Z" fill="white" />
          </svg>
        </button>
      </form>
    </div>
  </div>
</div>
<!-- newsletter section end -->

@endsection
