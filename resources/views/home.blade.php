@extends('layouts.app')

@section('content')
<!-- mobile menu start -->
<div class="offcanvas offcanvas-start roister-mobile-menu-offcanvas" data-bs-scroll="true" tabindex="-1" id="roister-mobile-menu-offcanvas">
  <nav class="d-lg-none">
    <div class="nav mobile-tab-nav" id="nav-tab" role="tablist">
      <button class="nav-link active" id="nav-about-us-tab" data-bs-toggle="tab" data-bs-target="#nav-about-us" type="button" role="tab" aria-controls="nav-about-us" aria-selected="true">ABOUT TARVAN</button>
      <button class="nav-link" id="nav-menu-tab" data-bs-toggle="tab" data-bs-target="#nav-menu" type="button" role="tab" aria-controls="nav-menu" aria-selected="false">MENU</button>
    </div>
  </nav>
  <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-about-us" role="tabpanel" aria-labelledby="nav-about-us-tab">
      <div class="offcanvas-header">
        <div class="logo">
          <a href="{{ url('/') }}">
            <img class="header-logo" src="{{ asset('assets/images/logos/white-logo.png') }}" alt="logo">
          </a>
        </div>
        <button type="button" class="mobile-menu-close-btn" data-bs-dismiss="offcanvas" aria-label="Close">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>

      <div class="offcanvas-body">
        <div class="short-about-wraper">
          <p>
            So Sweet Tarvan celebrates the heart of Nigerian cuisine. From smoky party Jollof to pepper soup and suya, every dish is made fresh and seasoned with passion. Whether you dine in or order online, expect warmth, spice, and flavor in every bite.
          </p>

          <div class="sidebar-popup-contact">
            <h4>Contact Info</h4>
            <ul>
              <li>
                <div class="icon"><i class="far fa-envelope"></i></div>
                <div class="content">
                  <h6>Email</h6>
                  <a href="mailto:info@sosweet.com">info@sosweet.com</a>
                </div>
              </li>
              <li>
                <div class="icon"><i class="fa-solid fa-phone"></i></div>
                <div class="content">
                  <h6>Phone</h6>
                  <a href="tel:+2348012345678">+234 801 234 5678</a>
                </div>
              </li>
              <li>
                <div class="icon"><i class="fa-solid fa-location-dot"></i></div>
                <div class="content">
                  <h6>Address</h6>
                  <a href="#">Port Harcourt, Nigeria</a>
                </div>
              </li>
            </ul>
          </div>

          <div class="sidebar-popup-social">
            <h4>Follow Us</h4>
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fa-brands fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin"></i></a>
          </div>
        </div>
      </div>
    </div>

    <div class="tab-pane fade" id="nav-menu" role="tabpanel" aria-labelledby="nav-menu-tab">
      <div class="offcanvas-header">
        <div class="logo">
          <a href="{{ url('/') }}">
            <img class="header-logo" src="{{ asset('assets/images/logos/white-logo.png') }}" alt="logo">
          </a>
        </div>
        <button type="button" class="mobile-menu-close-btn" data-bs-dismiss="offcanvas" aria-label="Close">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>
      <div class="offcanvas-body">
        <nav class="mobile-menu">
          <ul>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="{{ route('about') }}">About</a></li>
            <li><a href="{{ route('shop') }}">Shop</a></li>
            <li><a href="#">Contact</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</div>
<!-- mobile menu end -->

<!-- hero section start -->
<section class="roister-hero-section">
  <img class="hero-shape-1 wow fadeIn" data-wow-delay=".4s" src="{{ asset('assets/images/hero-shape-1.jpg') }}" alt="img">
  <img class="hero-shape-2 wow fadeIn" data-wow-delay=".4s" src="{{ asset('assets/images/hero-shape-2.jpg') }}" alt="img">
  <img class="hero-shape-3 item-bounce" src="{{ asset('assets/images/hero-shape-3.jpg') }}" alt="img">

  <div class="container">
    <div class="row">
      <div class="col-lg-7">
        <div class="hero-contents">
          <h5 class="subtitle mb-16 wow fadeInUp">
            <svg width="67" height="12" viewBox="0 0 67 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M66.7735 6L61 0.226497L55.2265 6L61 11.7735L66.7735 6ZM61 5L8.74228e-08 4.99999L-8.74228e-08 6.99999L61 7L61 5Z" fill="#F39C12"/></svg>
            Experience the Taste of True Nigerian Flavor
          </h5>
          <h1 class="title mb-60 wow fadeInUp" data-wow-delay=".2s">
            Jollof, Suya & More — Fresh, Spicy, Sweet
          </h1>
          <div class="btn-wraper wow fadeInUp" data-wow-delay=".3s">
            <a href="{{ route('shop') }}" class="primary-btn border-radius-6">Order Now
              <svg width="7" height="11" viewBox="0 0 7 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.34375 5.78125L1.78125 10.4062C1.625 10.5625 1.375 10.5625 1.25 10.4062L0.625 9.78125C0.46875 9.625 0.46875 9.40625 0.625 9.25L4.3125 5.5L0.625 1.78125C0.46875 1.625 0.46875 1.375 0.625 1.25L1.25 0.625C1.375 0.46875 1.625 0.46875 1.78125 0.625L6.34375 5.25C6.5 5.40625 6.5 5.625 6.34375 5.78125Z" fill="white"/></svg>
            </a>
            <div class="trip-info-wraper">
              <div class="icon-wraper"><i class="fa-solid fa-star text-warning"></i></div>
              <div class="content-wraper">
                <h6 class="trip-title mb-6">Customer Rating</h6>
                <p class="trip-des">4.9 / 5 Trust Score</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-5 wow fadeIn" data-wow-delay=".4s">
        <img class="hero-main-img" src="{{ asset('assets/images/hero-img.png') }}" alt="img">
      </div>
    </div>
  </div>
  <div class="book-table-content">
    <h4 class="title">Book a Table at Tarvan</h4>
  </div>
</section>
<!-- hero section end -->

<!-- about section start -->
<section class="roister-about-section py-120" data-background="{{ asset('assets/images/bg/about-bg.png') }}">
  <img class="about-shape" src="{{ asset('assets/images/shapes/about-shape.png') }}" alt="img">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 mb-60 mb-lg-0">
        <div class="reveal-img">
          <img class="main-img" src="{{ asset('assets/images/about-img.png') }}" alt="img">
        </div>
      </div>
      <div class="col-lg-6">
        <div class="contents-wraper">
          <h5 class="section-subtitle mb-8 wow fadeInUp" data-wow-delay=".2s">About Tarvan</h5>
          <h2 class="section-title mb-32 wow fadeInUp" data-wow-delay=".3s">Where Nigerian Taste Meets Modern Service</h2>
          <p class="des mb-40 wow fadeInUp" data-wow-delay=".4s">
            So Sweet Tarvan brings you a vibrant selection of Nigerian dishes — from pounded yam & egusi to smoky jollof rice and grilled suya. We combine the nostalgia of homemade cooking with the efficiency of modern dining and delivery.
          </p>
          <a href="{{ route('about') }}" class="primary-btn border-radius-6 mb-60 wow fadeInUp" data-wow-delay=".5s">Learn More</a>
          <img class="about-img-1" src="{{ asset('assets/images/about-img-3.png') }}" alt="img">
          <div class="reveal-img"><img class="about-img-2" src="{{ asset('assets/images/about-img-2.jpeg') }}" alt="img"></div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- about section end -->

<!-- banner section -->
<div class="roister-banner-section wow fadeInUp" data-wow-delay=".6s">
  <a href="{{ route('shop') }}"><img class="ratio ratio-16x9" src="{{ asset('assets/images/discount-banner1.jpg') }}" alt="img"></a>
</div>

<!-- Tarvan Menu Section with Category Filters -->
<section class="roister-best-dishes-section py-120">
  <!-- shapes -->
  <img class="shape-1" src="{{ asset('assets/images/shapes/dish-shape-1.png') }}" alt="img">
  <img class="shape-2" src="{{ asset('assets/images/shapes/dish-shape-2.png') }}" alt="img">
  <img class="shape-3 item-bounce" src="{{ asset('assets/images/shapes/dish-shape-3.png') }}" alt="img">
  <img class="shape-4" src="{{ asset('assets/images/shapes/dish-shape-4.png') }}" alt="img">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 text-center">
        <h2 class="section-title mb-18 wow fadeInUp">Explore Our Menu</h2>
        <p class="des mb-40 wow fadeInUp" data-wow-delay=".2s">
          From local soups to rice platters and grills — find your favorite Nigerian meal below.
        </p>
      </div>
    </div>

    <!-- Category Filter Buttons -->
    <div class="menu-filter text-center mb-60 wow fadeInUp" data-wow-delay=".3s">
      <button class="filter-btn active" data-filter="all">All</button>
      <button class="filter-btn" data-filter="soups">Soups & Stews</button>
      <button class="filter-btn" data-filter="swallows">Swallows</button>
      <button class="filter-btn" data-filter="rice">Rice Dishes</button>
      <button class="filter-btn" data-filter="grills">Grills & BBQ</button>
      <button class="filter-btn" data-filter="snacks">Snacks</button>
      <button class="filter-btn" data-filter="drinks">Drinks</button>
    </div>

    <!-- Meals Grid -->
    <div class="row gy-4 menu-grid">
      @foreach($products as $product)
        @php
          $categorySlug = strtolower(str_replace(' ', '-', $product->category->name ?? 'all'));
        @endphp
        <div class="col-12 col-md-6 col-lg-4 wow fadeInUp menu-item" data-category="{{ $categorySlug }}">
          <div class="roister-single-dish">
            <div class="img-wraper position-relative">
              <a href="{{ route('product.show', $product->id) }}">
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded-3">
              </a>
              <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form position-absolute top-0 start-0 m-3">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="cart-btn btn btn-warning text-white shadow-sm rounded-circle">
                  <i class="fa-solid fa-cart-plus"></i>
                </button>
              </form>

            </div>
            <div class="content-wraper">
              <div class="top-area mb-24 d-flex justify-content-between align-items-center">
                <h5 class="title"><a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a></h5>
                <a href="{{ route('product.show', $product->id) }}" class="primary-btn md border-radius-25">View</a>
              </div>
              <div class="btm-area d-flex justify-content-between align-items-center">
                <div class="rating-wraper text-warning">
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star-half-alt"></i>
                </div>
                <h4 class="price text-dark">₦{{ number_format($product->price, 2) }}</h4>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <div class="text-center mt-5">
      <a href="{{ route('shop') }}" class="primary-btn border-radius-6">View Full Menu</a>
    </div>
  </div>
</section>




<!-- newsletter -->
<div class="roister-newsletter-area">
  <div class="cta-card">
    <h4 class="mb-20 wow fadeInUp" data-wow-delay=".2s">Join the So Sweet Tarvan Family</h4>
    <a href="#" class="primary-btn border-radius-6 mb-50 wow fadeInUp" data-wow-delay=".3s">Contact Us</a>
    <div class="reveal-img"><img class="news-letter-img" src="{{ asset('assets/images/news-img-1.png') }}" alt="img"></div>
  </div>

  <div class="cta-calling-card wow fadeIn" data-wow-delay=".2s">
    <h3 class="title mb-30 wow fadeInUp" data-wow-delay=".3s">Fresh Meals, Real Taste</h3>
    <h5 class="subtitle wow fadeInUp" data-wow-delay=".4s">Chef Ngozi Ade</h5>
  </div>

  <div class="main-news-letter-card wow fadeInUp" data-wow-delay=".3s">
    <div class="reveal-img">
      <img class="main-img mb-30" src="{{ asset('assets/images/news-img-2.png') }}" alt="img">
    </div>
    <div class="btm-area wow fadeInUp" data-wow-delay=".2s">
      <h4 class="title">Subscribe for Updates & Offers</h4>
      <form class="form-wraper">
        <input type="text" placeholder="Enter Your Email">
        <button type="button" class="primary-btn border-radius-6 mb-50">Subscribe</button>
      </form>
    </div>
  </div>
</div>

<!-- team -->
<section class="roister-team-section py-120">
  <img class="shape-1" src="{{ asset('assets/images/team-shape1.png') }}" alt="img">
  <img class="shape-2" src="{{ asset('assets/images/team-shape2.png') }}" alt="img">
  <div class="container text-center">
    <h5 class="section-subtitle mb-8 wow fadeInUp">Meet Our Culinary Team</h5>
    <h2 class="section-title mb-32 wow fadeInUp" data-wow-delay=".4s">Masters of Taste & Tradition</h2>
    <!-- same team cards, text changed -->
  </div>
</section>

<!-- FAQ -->
<section class="roister-home-faq-section py-120">
  <div class="container">
    <h2 class="mb-60 wow fadeInUp">Frequently Asked Questions</h2>
    <div class="roister-home1-accordion" id="accordionNsFaq">
      <div class="faq-item wow fadeInUp" data-wow-delay=".2s">
        <h6 class="title" data-bs-toggle="collapse" data-bs-target="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
          What Nigerian meals do you serve daily?
        </h6>
        <div id="collapse-1" class="accordion-collapse collapse show" data-bs-parent="#accordionNsFaq">
          <p class="des">We offer jollof rice, fried rice, pounded yam with egusi, suya, nkwobi, grilled fish and more — freshly prepared every day.</p>
        </div>
      </div>
      <div class="faq-item wow fadeInUp" data-wow-delay=".3s">
        <h6 class="title" data-bs-toggle="collapse" data-bs-target="#collapse-2">Do you deliver outside Port Harcourt?</h6>
        <div id="collapse-2" class="accordion-collapse collapse" data-bs-parent="#accordionNsFaq">
          <p class="des">Yes, we deliver within Port Harcourt and nearby locations through trusted courier partners.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ticker area start -->
<div class="roister-ticker-wraper py-100" data-background="assets/images/bg/tickker-bg.png">
  <div class="ticker-wraper wow fadeInUp" data-wow-delay=".9s">
    <div class="hero-carousel-wraper left-ticker mb-60">
      <span class="title">Jollof_Rice</span>
      <span class="title">Suya_Spice</span>
      <span class="title">Pepper_Soup</span>
      <span class="title">Pounded_Yam</span>
      <span class="title">Egusi_Soup</span>
      <span class="title">Grilled_Fish</span>
      <span class="title">Chicken_Stew</span>
      <span class="title">Moi_Moi</span>
      <span class="title">Akara_Balls</span>
      <span class="title">Nkwobi_Special</span>
    </div>
    <div class="hero-carousel-wraper right-ticker">
      <span class="title-2">Jollof_Rice</span>
      <span class="title-2">Suya_Spice</span>
      <span class="title-2">Pepper_Soup</span>
      <span class="title-2">Pounded_Yam</span>
      <span class="title-2">Egusi_Soup</span>
      <span class="title-2">Grilled_Fish</span>
      <span class="title-2">Chicken_Stew</span>
      <span class="title-2">Moi_Moi</span>
      <span class="title-2">Akara_Balls</span>
      <span class="title-2">Nkwobi_Special</span>
    </div>
  </div>
</div>
<!-- ticker area end -->

<!-- testimonial section start -->
<section class="roister-testimonial-section py-120">

  <!-- shapes -->
  <img class="shape-1" src="assets/images/testi-shap1.png" alt="img">
  <img class="shape-2" src="assets/images/testi-shap2.png" alt="img">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-7 text-center">
        <h5 class="section-subtitle mb-8 wow fadeInUp">What Our People Say</h5>
        <h2 class="section-title mb-32 wow fadeInUp" data-wow-delay=".2s">Taste of Naija Excellence</h2>
      </div>
    </div>


    <div class="roister-testi-slider-wraper owl-carousel owl-theme">
      <div class="roister-single-testimonial">
        <div class="img-wraper">
          <img src="assets/images/nigerian-businesswoman-testimonial.jpg" alt="Chioma Okoro - Port Harcourt Businesswoman">
        </div>
        <div class="content-wraper">
          <p class="des mb-40">
            This Jollof Rice na die! The party just dey my mouth. As I chop that Suya, 
            I swear, heaven don land for Port Harcourt. Na so food suppose taste - original Nigerian flavour!
          </p>
          <div class="btm-wraper">
            <h6 class="feedback-name">
              <svg class="quote-icon" width="66" height="51" viewBox="0 0 66 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5.88235 46.4481C2.20588 42.404 0 37.9922 0 30.6392C0 17.7716 9.19118 6.37454 22.0588 0.492188L25.3677 5.2716C13.2353 11.8892 10.6618 20.3451 9.92647 25.8598C11.7647 24.7569 14.3382 24.3892 16.9118 24.7569C23.5294 25.4922 28.6765 30.6392 28.6765 37.6245C28.6765 40.9334 27.2059 44.2422 25 46.8157C22.4265 49.3892 19.4853 50.4922 15.8088 50.4922C11.7647 50.4922 8.08824 48.654 5.88235 46.4481ZM42.6471 46.4481C38.9706 42.404 36.7647 37.9922 36.7647 30.6392C36.7647 17.7716 45.9559 6.37454 58.8235 0.492188L62.1324 5.2716C50 11.8892 47.4265 20.3451 46.6912 25.8598C48.5294 24.7569 51.103 24.3892 53.6765 24.7569C60.2941 25.4922 65.4412 30.6392 65.4412 37.6245C65.4412 40.9334 63.9706 44.2422 61.7647 46.8157C59.5588 49.3892 56.25 50.4922 52.5735 50.4922C48.5294 50.4922 44.853 48.654 42.6471 46.4481Z" fill="#F39C12" />
              </svg>

              Chinedu Okoro/ <span>Port Harcourt Businesswoman</span>
            </h6>

            <div class="rating-wraper">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
            </div>

          </div>
        </div>
      </div>
      <div class="roister-single-testimonial">
        <div class="img-wraper">
          <img src="assets/images/nigerian-lady-testimonial.jpg" alt="Aisha Bello - Regular Customer">
        </div>
        <div class="content-wraper">
          <p class="des mb-40">
            The Pepper Soup here reminds me of my grandmother's cooking in the village. 
            The spices are perfect, and the fish is always fresh. Na real home away from home!
          </p>
          <div class="btm-wraper">
            <h6 class="feedback-name">
              <svg class="quote-icon" width="66" height="51" viewBox="0 0 66 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5.88235 46.4481C2.20588 42.404 0 37.9922 0 30.6392C0 17.7716 9.19118 6.37454 22.0588 0.492188L25.3677 5.2716C13.2353 11.8892 10.6618 20.3451 9.92647 25.8598C11.7647 24.7569 14.3382 24.3892 16.9118 24.7569C23.5294 25.4922 28.6765 30.6392 28.6765 37.6245C28.6765 40.9334 27.2059 44.2422 25 46.8157C22.4265 49.3892 19.4853 50.4922 15.8088 50.4922C11.7647 50.4922 8.08824 48.654 5.88235 46.4481ZM42.6471 46.4481C38.9706 42.404 36.7647 37.9922 36.7647 30.6392C36.7647 17.7716 45.9559 6.37454 58.8235 0.492188L62.1324 5.2716C50 11.8892 47.4265 20.3451 46.6912 25.8598C48.5294 24.7569 51.103 24.3892 53.6765 24.7569C60.2941 25.4922 65.4412 30.6392 65.4412 37.6245C65.4412 40.9334 63.9706 44.2422 61.7647 46.8157C59.5588 49.3892 56.25 50.4922 52.5735 50.4922C48.5294 50.4922 44.853 48.654 42.6471 46.4481Z" fill="#F39C12" />
              </svg>

              Aisha Bello/ <span>Regular Customer</span>
            </h6>

            <div class="rating-wraper">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
            </div>

          </div>
        </div>
      </div>
      <div class="roister-single-testimonial">
        <div class="img-wraper">
          <img src="assets/images/nigerian-executive-testimonial.jpg" alt="Emeka Nwankwo - Business Executive">
        </div>
        <div class="content-wraper">
          <p class="des mb-40">
            I bring my foreign partners here to experience true Nigerian hospitality. 
            The Pounded Yam and Egusi soup combination is legendary. Na the real definition of "swallow"!
          </p>
          <div class="btm-wraper">
            <h6 class="feedback-name">
              <svg class="quote-icon" width="66" height="51" viewBox="0 0 66 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5.88235 46.4481C2.20588 42.404 0 37.9922 0 30.6392C0 17.7716 9.19118 6.37454 22.0588 0.492188L25.3677 5.2716C13.2353 11.8892 10.6618 20.3451 9.92647 25.8598C11.7647 24.7569 14.3382 24.3892 16.9118 24.7569C23.5294 25.4922 28.6765 30.6392 28.6765 37.6245C28.6765 40.9334 27.2059 44.2422 25 46.8157C22.4265 49.3892 19.4853 50.4922 15.8088 50.4922C11.7647 50.4922 8.08824 48.654 5.88235 46.4481ZM42.6471 46.4481C38.9706 42.404 36.7647 37.9922 36.7647 30.6392C36.7647 17.7716 45.9559 6.37454 58.8235 0.492188L62.1324 5.2716C50 11.8892 47.4265 20.3451 46.6912 25.8598C48.5294 24.7569 51.103 24.3892 53.6765 24.7569C60.2941 25.4922 65.4412 30.6392 65.4412 37.6245C65.4412 40.9334 63.9706 44.2422 61.7647 46.8157C59.5588 49.3892 56.25 50.4922 52.5735 50.4922C48.5294 50.4922 44.853 48.654 42.6471 46.4481Z" fill="#F39C12" />
              </svg>

              Emeka Nwankwo/ <span>Business Executive</span>
            </h6>

            <div class="rating-wraper">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- testimonial section end -->

<!-- photo gallery start -->
<section class="roister-photo-gallery-section" data-background="assets/images/bg/gallery-bg.jpg">
  <div class="container">
    <div class="row">
      <div class="col-lg-5 mb-60 mb-lg-0">
        <div class="contents-wraper">
          <h5 class="mb-8 wow fadeInUp">Naija Food Pics</h5>
          <h2 class="section-title mb-24 wow fadeInUp" data-wow-delay=".2s">Our Kitchen Vibes</h2>
          <p class="des mb-24 wow fadeInUp" data-wow-delay=".4s">
            Experience the rich flavors and vibrant colors of authentic Nigerian cuisine. 
            From our smoky Suya grill to our bubbling pots of traditional soups, every dish tells a story of Nigerian heritage.
          </p>
          <a href="#" class="primary-btn border-radius-6 wow fadeInUp" data-wow-delay=".6s">See More Food
            <svg width="7" height="11" viewBox="0 0 7 11" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M6.34375 5.78125L1.78125 10.4062C1.625 10.5625 1.375 10.5625 1.25 10.4062L0.625 9.78125C0.46875 9.625 0.46875 9.40625 0.625 9.25L4.3125 5.5L0.625 1.78125C0.46875 1.625 0.46875 1.375 0.625 1.25L1.25 0.625C1.375 0.46875 1.625 0.46875 1.78125 0.625L6.34375 5.25C6.5 5.40625 6.5 5.625 6.34375 5.78125Z" fill="white" />
            </svg>
          </a>
        </div>
      </div>

      <div class="col-lg-7 slider-col">
        <div class="roister-gallery-slider owl-carousel owl-theme">
          <div class="roister-single-gallery">
            <img src="assets/images/gallery-1.jpg" alt="img">
            <a class="gallery-trigger" href="assets/images/gallery-1.jpg"><i class="fa-brands fa-instagram"></i></a>
            <div class="column-overlay">
              <a href="assets/images/gallery-1.jpg"></a>
              <a href="assets/images/gallery-2.jpg"></a>
              <a href="assets/images/gallery-3.jpg"></a>
              <a href="assets/images/gallery-4.jpg"></a>
              <a href="assets/images/gallery-5.jpg"></a>
            </div>
          </div>
          <div class="roister-single-gallery">
            <img src="assets/images/gallery-2.jpg" alt="img">
            <a class="gallery-trigger" href="assets/images/gallery-2.jpg"><i class="fa-brands fa-instagram"></i></a>
            <div class="column-overlay">
              <a href="assets/images/gallery-1.jpg"></a>
              <a href="assets/images/gallery-2.jpg"></a>
              <a href="assets/images/gallery-3.jpg"></a>
              <a href="assets/images/gallery-4.jpg"></a>
              <a href="assets/images/gallery-5.jpg"></a>
            </div>
          </div>
          <div class="roister-single-gallery">
            <img src="assets/images/gallery-3.jpg" alt="img">
            <a class="gallery-trigger" href="assets/images/gallery-3.jpg"><i class="fa-brands fa-instagram"></i></a>
            <div class="column-overlay">
              <a href="assets/images/gallery-1.jpg"></a>
              <a href="assets/images/gallery-2.jpg"></a>
              <a href="assets/images/gallery-3.jpg"></a>
              <a href="assets/images/gallery-4.jpg"></a>
              <a href="assets/images/gallery-5.jpg"></a>
            </div>
          </div>
          <div class="roister-single-gallery">
            <img src="assets/images/gallery-4.jpg" alt="img">
            <a class="gallery-trigger" href="assets/images/gallery-4.jpg"><i class="fa-brands fa-instagram"></i></a>
            <div class="column-overlay">
              <a href="assets/images/gallery-1.jpg"></a>
              <a href="assets/images/gallery-2.jpg"></a>
              <a href="assets/images/gallery-3.jpg"></a>
              <a href="assets/images/gallery-4.jpg"></a>
              <a href="assets/images/gallery-5.jpg"></a>
            </div>
          </div>
          <div class="roister-single-gallery">
            <img src="assets/images/gallery-5.jpg" alt="img">
            <a class="gallery-trigger" href="assets/images/gallery-5.jpg"><i class="fa-brands fa-instagram"></i></a>
            <div class="column-overlay">
              <a href="assets/images/gallery-1.jpg"></a>
              <a href="assets/images/gallery-2.jpg"></a>
              <a href="assets/images/gallery-3.jpg"></a>
              <a href="assets/images/gallery-4.jpg"></a>
              <a href="assets/images/gallery-5.jpg"></a>
            </div>
          </div>
        </div>
      </div>


    </div>
  </div>
</section>
<!-- photo gallery end -->


@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const filterButtons = document.querySelectorAll('.filter-btn');
  const dishes = document.querySelectorAll('.menu-item');

  filterButtons.forEach(btn => {
    btn.addEventListener('click', function() {
      filterButtons.forEach(b => b.classList.remove('active'));
      this.classList.add('active');

      const category = this.getAttribute('data-filter');

      dishes.forEach(dish => {
        if (category === 'all' || dish.dataset.category === category) {
          dish.style.display = 'block';
          dish.classList.add('animate__fadeIn');
        } else {
          dish.style.display = 'none';
        }
      });
    });
  });
});
</script>

<style>
/* ensure this sits above any global styles */
.menu-filter {
  position: relative;
  z-index: 50;
  text-align: center;
}

.menu-filter .filter-btn {
  display: inline-block;
  border: 2px solid #d35400;
  background-color: rgba(255,255,255,0.1);
  color: #ffffff !important;          /* <- always white text */
  font-weight: 600;
  font-size: 15px;
  border-radius: 30px;
  padding: 10px 24px;
  margin: 6px;
  cursor: pointer;
  transition: all .25s ease;
  text-transform: capitalize;
  position: relative;
}

.menu-filter .filter-btn:hover,
.menu-filter .filter-btn.active {
  background-color: #d35400 !important;
  color: #fff !important;
  border-color: #ffae42;
  box-shadow: 0 0 12px rgba(255,165,0,.5);
  transform: translateY(-2px);
}

/* give some separation from dark section */
.roister-best-dishes-section {
  background-color: #0b0b0b;
  color: #fff;
  padding-top: 120px;
  padding-bottom: 120px;
  position: relative;
  z-index: 1;
}

.section-title { color: #fff !important; }
.des { color: #f2e6d9 !important; }
</style>


@endsection
