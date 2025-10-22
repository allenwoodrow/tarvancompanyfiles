<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from demo.orbitaps.com/html/roister/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 17 Oct 2025 11:03:14 GMT -->
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>So Sweet Tarvan - Fast Food Ordering Restaurant & Cafe</title>
  <!--Essential css files-->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/nice-select.css">
  <link rel="stylesheet" href="assets/css/animate.css">
  <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
  <link rel="stylesheet" href="assets/css/magnific-popup.css">
  <link rel="stylesheet" href="assets/css/all.css">
  <link rel="stylesheet" href="assets/css/lenis.css">
  <link rel="stylesheet" href="assets/css/style.css">

  <!--favicon-->
  <link rel="icon" href="assets/images/favicon.png">
</head>

<!-- add this class for rtl rtl-enabled -->

<body class="">


    <!-- Header -->
    @include('layouts.navigation')

    <!-- Page Content -->
    <main>
        @yield('content')
    </main>

    <!-- scroll to top -->
<button type="button" class="scroll-top-btn">
  <i class="fa-solid fa-angles-up"></i>
</button>

<!--Esential Js Files-->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/nice-select.js"></script>
<script src="assets/js/wow.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/magnific-popup.js"></script>
<script src="assets/js/counterup.js"></script>
<script src="assets/js/waypoints.min.js"></script>
<script src="assets/js/lenis.min.js"></script>
<script src="assets/js/gsap.min.js"></script>
<script src="assets/js/ScrollTrigger.min.js"></script>
<script src="assets/js/default-passive-events.js"></script>
<script src="assets/js/script.js"></script>


<script>
document.addEventListener('DOMContentLoaded', function() {
  const cartCounter = document.querySelector('.cart-counter');

  // Intercept all add-to-cart forms
  document.querySelectorAll('form[action="{{ route('cart.add') }}"]').forEach(form => {
    form.addEventListener('submit', function(e) {
      e.preventDefault();

      const formData = new FormData(form);

      fetch(form.action, {
        method: 'POST',
        credentials: 'same-origin', // Ensures session cookie is sent
        headers: {
          'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
          'Accept': 'application/json'
        },
        body: formData
      })
      .then(async res => {
        if (res.status === 401) {
          // Laravel returns 401 if unauthenticated
          const data = await res.json().catch(() => ({}));
          window.location.href = data.redirect || "{{ route('login') }}";
          return;
        }

        const data = await res.json();

        if (data.success) {
          cartCounter.textContent = data.cart_count || 0;

          const alertBox = document.createElement('div');
          alertBox.className = 'position-fixed top-0 end-0 m-3 p-3 bg-success text-white rounded shadow';
          alertBox.innerHTML = `<i class="fa fa-check-circle me-2"></i>${data.message}`;
          document.body.appendChild(alertBox);
          setTimeout(() => alertBox.remove(), 2500);
        } else if (data.redirect) {
          window.location.href = data.redirect;
        } else {
          alert(data.message || 'Something went wrong.');
        }
      })
      .catch(err => {
        console.error('Add to cart error:', err);
        alert('Failed to add item. Please try again.');
      });
    });
  });
});
</script>




</body>


<!-- Mirrored from demo.orbitaps.com/html/roister/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 17 Oct 2025 11:04:26 GMT -->
</html>
