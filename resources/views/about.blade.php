@extends('layouts.app')

@section('content')

<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="container">   
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <h3>About Us</h3>
                    <ul>
                        <li><a href="{{ route('home') }}">home</a></li>
                        <li>about us</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>         
</div>
<!--breadcrumbs area end-->

<!--about section area -->
<section class="about_section"> 
   <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="about_content">
                    <h1>About SOD LIFE+STYLE</h1>
                    <h3>Redefining Men's Fashion in Nigeria with Quality, Style, and Authenticity</h3>
                    <p>Founded on November 6, 2023, by Miyenbaikebi Prince Tanro, SOD LIFE+STYLE emerged from a vision to elevate men's fashion in Bayelsa State and across Nigeria. Based in Old Assembly Quarters, Yenegoa, our company is committed to providing premium men's clothing that combines contemporary style with traditional Nigerian craftsmanship.</p>
                    <p>We understand the unique fashion needs of the modern Nigerian man – the need for clothing that is both stylish and practical for our climate, that respects our cultural heritage while embracing global trends. Every piece in our collection is carefully selected or designed to meet these needs, ensuring our customers look their best in any setting.</p>
                    <p>At SOD LIFE+STYLE, we believe that clothing is more than just fabric – it's an expression of identity, confidence, and culture. This belief drives everything we do, from our product selection to our customer service.</p>
                </div>
            </div>  
            <div class="col-lg-6">
                <div class="about_thumb">
                    <img src="assets/img/logo/image0001.jpg" alt="SOD LIFE+STYLE Men's Fashion">
                </div>
            </div>
        </div>  
    </div> 
</section>
<!--about section end-->

<!--chose us area start-->
<div class="choseus_area" data-bgimg="assets/img/about/about-us-policy-bg.jpg">
    <div class="container">   
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="single_chose">
                    <div class="chose_icone">
                        <img src="assets/img/about/quality-icon.png" alt="Quality Guarantee">
                    </div>
                    <div class="chose_content">
                        <h3>Premium Quality</h3>
                        <p>We source only the finest fabrics that withstand the Nigerian climate while maintaining style, comfort, and durability.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single_chose">
                    <div class="chose_icone">
                        <img src="assets/img/about/money-back-icon.png" alt="Money Back Guarantee">
                    </div>
                    <div class="chose_content">
                        <h3>Satisfaction Guaranteed</h3>
                        <p>We stand behind our products with a 100% satisfaction guarantee and easy return policy across Nigeria.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single_chose chose3">
                    <div class="chose_icone">
                        <img src="assets/img/about/support-icon.png" alt="Customer Support">
                    </div>
                    <div class="chose_content">
                        <h3>Local Support</h3>
                        <p>Our Bayelsa-based team provides personalized service and understands the unique style needs of Nigerian men.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>
<!--chose us area end-->      

<!--services img area-->
<div class="about_gallery_section"> 
    <div class="container">
       <div class="about_gallery_container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <article class="single_gallery_section">
                        <figure>
                            <div class="gallery_thumb">
                                <img src="assets/img/about/what-we-do.jpg" alt="What We Do">
                            </div>
                            <figcaption class="about_gallery_content">
                               <h3>Our Mission</h3>
                                <p>To empower Nigerian men through fashion by providing quality, affordable clothing that celebrates African heritage while embracing global trends. We aim to be the premier destination for men who want to express their individuality through style while staying comfortable in Nigeria's unique climate.</p>
                            </figcaption>
                        </figure>
                    </article>
                </div>
                <div class="col-lg-4 col-md-6">
                    <article class="single_gallery_section">
                        <figure>
                            <div class="gallery_thumb">
                                <img src="assets/img/about/our-values.jpg" alt="Our Values">
                            </div>
                            <figcaption class="about_gallery_content">
                               <h3>Our Values</h3>
                                <p>Quality craftsmanship, authentic style, customer satisfaction, and community development. We believe in supporting local economies and promoting Nigerian fashion talent while providing our customers with exceptional value and service.</p>
                            </figcaption>
                        </figure>
                    </article>
                </div>
                <div class="col-lg-4 col-md-6">
                    <article class="single_gallery_section col__3">
                        <figure>
                            <div class="gallery_thumb">
                                <img src="assets/img/about/our-approach.jpg" alt="Our Approach">
                            </div>
                            <figcaption class="about_gallery_content">
                               <h3>Our Approach</h3>
                                <p>We combine traditional Nigerian textile expertise with contemporary design sensibilities. Each garment is selected or designed with attention to detail, ensuring it meets our high standards for quality, comfort, and style that resonates with the modern Nigerian man.</p>
                            </figcaption>
                        </figure>
                    </article>
                </div>
            </div> 
        </div>
    </div>      
</div>
<!--services img end-->    

<!--testimonial area start-->
<div class="faq-client-say-area">
    <div class="container">   
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="faq-client_title">
                    <h2>Frequently Asked Questions</h2>
                </div>
                <div class="faq-style-wrap" id="faq-five">
                    <!-- Panel-default -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5 class="panel-title">
                                <a id="octagon" class="collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse1" aria-expanded="true" aria-controls="faq-collapse1"> <span class="button-faq"></span>Do you deliver across Nigeria?</a>
                            </h5>
                        </div>
                        <div id="faq-collapse1" class="collapse show" aria-expanded="true" role="tabpanel" data-parent="#faq-five">
                            <div class="panel-body">
                                <p>Yes, we deliver to all 36 states in Nigeria. We partner with reliable logistics companies to ensure your order reaches you safely and on time. Delivery times vary by location but typically range from 2-7 business days depending on your location.</p>
                            </div>
                        </div>
                    </div>
                    <!--// Panel-default -->

                    <!-- Panel-default -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5 class="panel-title">
                                <a class="collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse2" aria-expanded="false" aria-controls="faq-collapse2"> <span class="button-faq"></span>How do I know my correct size?</a>
                            </h5>
                        </div>
                        <div id="faq-collapse2" class="collapse" aria-expanded="false" role="tabpanel" data-parent="#faq-five">
                            <div class="panel-body">
                                <p>We provide detailed size charts for all our products. You can also contact our customer service team via WhatsApp for personalized sizing advice. If you're between sizes, we recommend choosing the larger size for comfort, especially in our climate.</p>
                            </div>
                        </div>
                    </div>
                    <!--// Panel-default -->

                    <!-- Panel-default -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5 class="panel-title">
                                <a class="collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse3" aria-expanded="false" aria-controls="faq-collapse3"> <span class="button-faq"></span>What payment methods do you accept?</a>
                            </h5>
                        </div>
                        <div id="faq-collapse3" class="collapse" role="tabpanel" data-parent="#faq-five">
                            <div class="panel-body">
                                <p>We accept multiple payment options including bank transfers, debit cards, and payments through Flutterwave. We also offer pay-on-delivery for orders within Yenegoa and surrounding areas (terms and conditions apply).</p>
                            </div>
                        </div>
                    </div>
                    <!--// Panel-default -->

                    <!-- Panel-default -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5 class="panel-title">
                                <a class="collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse4" aria-expanded="false" aria-controls="faq-collapse4"> <span class="button-faq"></span>Can I visit your physical store?</a>
                            </h5>
                        </div>
                        <div id="faq-collapse4" class="collapse" role="tabpanel" data-parent="#faq-five">
                            <div class="panel-body">
                                <p>Yes, we welcome visitors to our showroom at Old Assembly Quarters, Yenegoa, Bayelsa State. Our store hours are Monday to Saturday, 9am to 6pm. You can try on items and get personalized styling advice from our team.</p>
                            </div>
                        </div>
                    </div>
                    <!--// Panel-default -->
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <!--testimonial area start-->
                <div class="testimonial_container testimonial_about">
                     <div class="faq-client_title">
                        <h2>What Our Customers Say</h2>
                    </div>
                    <div class="testimonial_wrapper testimonial_collumn1 owl-carousel">
                        <div class="single_testimonial">
                            <div class="testimonial_thumb">
                                <img src="assets/img/about/testimonial-nigerian1.jpg" alt="Ebikebina">
                            </div>
                            <div class="testimonial_content">
                               <p>"As a professional in Yenegoa, finding quality office wear that suits our climate has always been challenging. SOD LIFE+STYLE has transformed my wardrobe. Their shirts are breathable yet professional, and the fit is perfect for Nigerian body types."</p>
                                <h3><a href="#">Ebikebina Owei</a></h3>
                                <span>Bank Manager, Yenegoa</span>
                            </div>
                        </div>
                        <div class="single_testimonial">
                            <div class="testimonial_thumb">
                                <img src="assets/img/about/testimonial-nigerian2.jpg" alt="Ebinimi">
                            </div>
                            <div class="testimonial_content">
                               <p>"I ordered traditional attire for my brother's wedding, and I was amazed by the quality and attention to detail. The delivery was prompt, and the customer service was exceptional. SOD LIFE+STYLE is now my go-to for all special occasions."</p>
                                <h3><a href="#">Ebinimi Francis</a></h3>
                                <span>Business Owner, Port Harcourt</span>
                            </div>
                        </div>
                        <div class="single_testimonial">
                            <div class="testimonial_thumb">
                                <img src="assets/img/about/testimonial-nigerian3.jpg" alt="Dagogo">
                            </div>
                            <div class="testimonial_content">
                               <p>"The casual wear collection is perfect for Bayelsa's weather. The fabrics are light and comfortable without sacrificing style. I appreciate that I can look fashionable while staying cool in our humid climate."</p>
                                <h3><a href="#">Dagogo Princewill</a></h3>
                                <span>University Student, Yenegoa</span>
                            </div>
                        </div>
                        <div class="single_testimonial">
                            <div class="testimonial_thumb">
                                <img src="assets/img/about/testimonial-nigerian4.jpg" alt="Tarila">
                            </div>
                            <div class="testimonial_content">
                               <p>"I've shopped with many online stores, but SOD LIFE+STYLE stands out for their authenticity and quality. The founder clearly understands Nigerian men's fashion needs. The pieces I've purchased have become staples in my wardrobe."</p>
                                <h3><a href="#">Tarila Ebizimor</a></h3>
                                <span>Civil Servant, Abuja</span>
                            </div>
                        </div>
                    </div>
               </div>
                <!--testimonial area end-->
            </div>
        </div>
    </div>    
</div>
<!--testimonial area end-->

<!--our team area start-->
<div class="our_team_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                   <h2>Meet Our Founder</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="team_member founder_highlight">
                    <div class="team_thumb">
                        <img src="assets/img/about/founder-miyenbaikebi.jpg" alt="Miyenbaikebi Prince Tanro">
                    </div>
                    <div class="team_content">
                        <h3>Miyenbaikebi Prince Tanro</h3>
                        <span>Founder & CEO</span>
                        <p>Miyenbaikebi Prince Tanro established SOD LIFE+STYLE on November 6, 2023, with a vision to redefine men's fashion in Bayelsa State and across Nigeria. With a deep understanding of Nigerian style sensibilities and a passion for quality craftsmanship, Prince has built a brand that celebrates African heritage while embracing contemporary trends.</p>
                        <p>His commitment to providing exceptional clothing that meets the unique needs of Nigerian men drives every aspect of SOD LIFE+STYLE's operations, from product selection to customer service.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-5">
            <div class="col-12">
                <div class="section_title">
                   <h2>Visit Us</h2>
                </div>
            </div>
            <div class="col-lg-8 mx-auto">
                <div class="store_address">
                    <div class="store_map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3978.234321012234!2d6.247229274019506!3d4.924895095089247!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x106a2b61bc1f2d0f%3A0x3c15edfd1f85b0b0!2sOld%20Assembly%20Quarters%2C%20Yenagoa%2C%20Bayelsa%20State%2C%20Nigeria!5e0!3m2!1sen!2s!4v1700000000000!5m2!1sen!2s" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                    <div class="store_info">
                        <h3>SOD LIFE+STYLE Store</h3>
                        <p><strong>Address:</strong> Old Assembly Quarters, Yenegoa, Bayelsa State, Nigeria</p>
                        <p><strong>Phone:</strong> +234 XXX XXX XXXX</p>
                        <p><strong>Email:</strong> info@sodlifestyle.com</p>
                        <p><strong>Hours:</strong> Monday - Saturday: 9am - 6pm</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--our team area end-->

@endsection