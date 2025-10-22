@extends('layouts.app')

@section('content')
<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="container">   
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <h3>Checkout</h3>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Checkout</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>         
</div>
<!--breadcrumbs area end-->

<!--Checkout page section-->
<div class="Checkout_section" id="accordion">
   <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="checkout_form">
            <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <h3>Billing Details</h3>
                        <div class="row">
                            <div class="col-lg-6 mb-20">
                                <label>First Name <span>*</span></label>
                                <input type="text" name="billing_first_name" 
                                    value="{{ old('billing_first_name', Auth::user()->name ? explode(' ', Auth::user()->name)[0] : '') }}" 
                                    required>
                            </div>
                            <div class="col-lg-6 mb-20">
                                <label>Last Name <span>*</span></label>
                                <input type="text" name="billing_last_name" 
                                    value="{{ old('billing_last_name', Auth::user()->name ? explode(' ', Auth::user()->name)[1] ?? '' : '') }}" 
                                    required>
                            </div>
                            <div class="col-12 mb-20">
                                <label>Email Address <span>*</span></label>
                                <input type="email" name="billing_email" 
                                    value="{{ old('billing_email', Auth::user()->email) }}" 
                                    required>
                            </div>
                            <div class="col-12 mb-20">
                                <label>Phone <span>*</span></label>
                                <input type="text" name="billing_phone" 
                                    value="{{ old('billing_phone', Auth::user()->phone) }}" 
                                    required>
                            </div>
                            <div class="col-12 mb-20">
                                <label for="billing_country">Country <span>*</span></label>
                            
                                <select class="select_option" name="billing_country" required>
                                        <option value="Nigeria" {{ old('billing_country') == 'Nigeria' ? 'selected' : '' }}>Nigeria</option>
                                        <option value="Afghanistan" {{ old('billing_country') == 'Afghanistan' ? 'selected' : '' }}>Afghanistan</option>
                                        <option value="Albania" {{ old('billing_country') == 'Albania' ? 'selected' : '' }}>Albania</option>
                                        <option value="Algeria" {{ old('billing_country') == 'Algeria' ? 'selected' : '' }}>Algeria</option>
                                        <option value="Andorra" {{ old('billing_country') == 'Andorra' ? 'selected' : '' }}>Andorra</option>
                                        <option value="Angola" {{ old('billing_country') == 'Angola' ? 'selected' : '' }}>Angola</option>
                                        <option value="Argentina" {{ old('billing_country') == 'Argentina' ? 'selected' : '' }}>Argentina</option>
                                        <option value="Armenia" {{ old('billing_country') == 'Armenia' ? 'selected' : '' }}>Armenia</option>
                                        <option value="Australia" {{ old('billing_country') == 'Australia' ? 'selected' : '' }}>Australia</option>
                                        <option value="Austria" {{ old('billing_country') == 'Austria' ? 'selected' : '' }}>Austria</option>
                                        <option value="Azerbaijan" {{ old('billing_country') == 'Azerbaijan' ? 'selected' : '' }}>Azerbaijan</option>
                                        <option value="Bahamas" {{ old('billing_country') == 'Bahamas' ? 'selected' : '' }}>Bahamas</option>
                                        <option value="Bahrain" {{ old('billing_country') == 'Bahrain' ? 'selected' : '' }}>Bahrain</option>
                                        <option value="Bangladesh" {{ old('billing_country') == 'Bangladesh' ? 'selected' : '' }}>Bangladesh</option>
                                        <option value="Barbados" {{ old('billing_country') == 'Barbados' ? 'selected' : '' }}>Barbados</option>
                                        <option value="Belarus" {{ old('billing_country') == 'Belarus' ? 'selected' : '' }}>Belarus</option>
                                        <option value="Belgium" {{ old('billing_country') == 'Belgium' ? 'selected' : '' }}>Belgium</option>
                                        <option value="Belize" {{ old('billing_country') == 'Belize' ? 'selected' : '' }}>Belize</option>
                                        <option value="Benin" {{ old('billing_country') == 'Benin' ? 'selected' : '' }}>Benin</option>
                                        <option value="Bhutan" {{ old('billing_country') == 'Bhutan' ? 'selected' : '' }}>Bhutan</option>
                                        <option value="Bolivia" {{ old('billing_country') == 'Bolivia' ? 'selected' : '' }}>Bolivia</option>
                                        <option value="Bosnia and Herzegovina" {{ old('billing_country') == 'Bosnia and Herzegovina' ? 'selected' : '' }}>Bosnia and Herzegovina</option>
                                        <option value="Botswana" {{ old('billing_country') == 'Botswana' ? 'selected' : '' }}>Botswana</option>
                                        <option value="Brazil" {{ old('billing_country') == 'Brazil' ? 'selected' : '' }}>Brazil</option>
                                        <option value="Brunei" {{ old('billing_country') == 'Brunei' ? 'selected' : '' }}>Brunei</option>
                                        <option value="Bulgaria" {{ old('billing_country') == 'Bulgaria' ? 'selected' : '' }}>Bulgaria</option>
                                        <option value="Burkina Faso" {{ old('billing_country') == 'Burkina Faso' ? 'selected' : '' }}>Burkina Faso</option>
                                        <option value="Burundi" {{ old('billing_country') == 'Burundi' ? 'selected' : '' }}>Burundi</option>
                                        <option value="Cambodia" {{ old('billing_country') == 'Cambodia' ? 'selected' : '' }}>Cambodia</option>
                                        <option value="Cameroon" {{ old('billing_country') == 'Cameroon' ? 'selected' : '' }}>Cameroon</option>
                                        <option value="Canada" {{ old('billing_country') == 'Canada' ? 'selected' : '' }}>Canada</option>
                                        <option value="Cape Verde" {{ old('billing_country') == 'Cape Verde' ? 'selected' : '' }}>Cape Verde</option>
                                        <option value="Central African Republic" {{ old('billing_country') == 'Central African Republic' ? 'selected' : '' }}>Central African Republic</option>
                                        <option value="Chad" {{ old('billing_country') == 'Chad' ? 'selected' : '' }}>Chad</option>
                                        <option value="Chile" {{ old('billing_country') == 'Chile' ? 'selected' : '' }}>Chile</option>
                                        <option value="China" {{ old('billing_country') == 'China' ? 'selected' : '' }}>China</option>
                                        <option value="Colombia" {{ old('billing_country') == 'Colombia' ? 'selected' : '' }}>Colombia</option>
                                        <option value="Comoros" {{ old('billing_country') == 'Comoros' ? 'selected' : '' }}>Comoros</option>
                                        <option value="Costa Rica" {{ old('billing_country') == 'Costa Rica' ? 'selected' : '' }}>Costa Rica</option>
                                        <option value="Croatia" {{ old('billing_country') == 'Croatia' ? 'selected' : '' }}>Croatia</option>
                                        <option value="Cuba" {{ old('billing_country') == 'Cuba' ? 'selected' : '' }}>Cuba</option>
                                        <option value="Cyprus" {{ old('billing_country') == 'Cyprus' ? 'selected' : '' }}>Cyprus</option>
                                        <option value="Czech Republic" {{ old('billing_country') == 'Czech Republic' ? 'selected' : '' }}>Czech Republic</option>
                                        <option value="Denmark" {{ old('billing_country') == 'Denmark' ? 'selected' : '' }}>Denmark</option>
                                        <option value="Djibouti" {{ old('billing_country') == 'Djibouti' ? 'selected' : '' }}>Djibouti</option>
                                        <option value="Dominican Republic" {{ old('billing_country') == 'Dominican Republic' ? 'selected' : '' }}>Dominican Republic</option>
                                        <option value="Ecuador" {{ old('billing_country') == 'Ecuador' ? 'selected' : '' }}>Ecuador</option>
                                        <option value="Egypt" {{ old('billing_country') == 'Egypt' ? 'selected' : '' }}>Egypt</option>
                                        <option value="El Salvador" {{ old('billing_country') == 'El Salvador' ? 'selected' : '' }}>El Salvador</option>
                                        <option value="Estonia" {{ old('billing_country') == 'Estonia' ? 'selected' : '' }}>Estonia</option>
                                        <option value="Ethiopia" {{ old('billing_country') == 'Ethiopia' ? 'selected' : '' }}>Ethiopia</option>
                                        <option value="Fiji" {{ old('billing_country') == 'Fiji' ? 'selected' : '' }}>Fiji</option>
                                        <option value="Finland" {{ old('billing_country') == 'Finland' ? 'selected' : '' }}>Finland</option>
                                        <option value="France" {{ old('billing_country') == 'France' ? 'selected' : '' }}>France</option>
                                        <option value="Germany" {{ old('billing_country') == 'Germany' ? 'selected' : '' }}>Germany</option>
                                        <option value="Ghana" {{ old('billing_country') == 'Ghana' ? 'selected' : '' }}>Ghana</option>
                                        <option value="Greece" {{ old('billing_country') == 'Greece' ? 'selected' : '' }}>Greece</option>
                                        <option value="Hungary" {{ old('billing_country') == 'Hungary' ? 'selected' : '' }}>Hungary</option>
                                        <option value="Iceland" {{ old('billing_country') == 'Iceland' ? 'selected' : '' }}>Iceland</option>
                                        <option value="India" {{ old('billing_country') == 'India' ? 'selected' : '' }}>India</option>
                                        <option value="Indonesia" {{ old('billing_country') == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                                        <option value="Iran" {{ old('billing_country') == 'Iran' ? 'selected' : '' }}>Iran</option>
                                        <option value="Iraq" {{ old('billing_country') == 'Iraq' ? 'selected' : '' }}>Iraq</option>
                                        <option value="Ireland" {{ old('billing_country') == 'Ireland' ? 'selected' : '' }}>Ireland</option>
                                        <option value="Israel" {{ old('billing_country') == 'Israel' ? 'selected' : '' }}>Israel</option>
                                        <option value="Italy" {{ old('billing_country') == 'Italy' ? 'selected' : '' }}>Italy</option>
                                        <option value="Jamaica" {{ old('billing_country') == 'Jamaica' ? 'selected' : '' }}>Jamaica</option>
                                        <option value="Japan" {{ old('billing_country') == 'Japan' ? 'selected' : '' }}>Japan</option>
                                        <option value="Jordan" {{ old('billing_country') == 'Jordan' ? 'selected' : '' }}>Jordan</option>
                                        <option value="Kenya" {{ old('billing_country') == 'Kenya' ? 'selected' : '' }}>Kenya</option>
                                        <option value="Kuwait" {{ old('billing_country') == 'Kuwait' ? 'selected' : '' }}>Kuwait</option>
                                        <option value="Latvia" {{ old('billing_country') == 'Latvia' ? 'selected' : '' }}>Latvia</option>
                                        <option value="Lebanon" {{ old('billing_country') == 'Lebanon' ? 'selected' : '' }}>Lebanon</option>
                                        <option value="Lithuania" {{ old('billing_country') == 'Lithuania' ? 'selected' : '' }}>Lithuania</option>
                                        <option value="Luxembourg" {{ old('billing_country') == 'Luxembourg' ? 'selected' : '' }}>Luxembourg</option>
                                        <option value="Madagascar" {{ old('billing_country') == 'Madagascar' ? 'selected' : '' }}>Madagascar</option>
                                        <option value="Malaysia" {{ old('billing_country') == 'Malaysia' ? 'selected' : '' }}>Malaysia</option>
                                        <option value="Maldives" {{ old('billing_country') == 'Maldives' ? 'selected' : '' }}>Maldives</option>
                                        <option value="Mali" {{ old('billing_country') == 'Mali' ? 'selected' : '' }}>Mali</option>
                                        <option value="Malta" {{ old('billing_country') == 'Malta' ? 'selected' : '' }}>Malta</option>
                                        <option value="Mexico" {{ old('billing_country') == 'Mexico' ? 'selected' : '' }}>Mexico</option>
                                        <option value="Monaco" {{ old('billing_country') == 'Monaco' ? 'selected' : '' }}>Monaco</option>
                                        <option value="Mongolia" {{ old('billing_country') == 'Mongolia' ? 'selected' : '' }}>Mongolia</option>
                                        <option value="Morocco" {{ old('billing_country') == 'Morocco' ? 'selected' : '' }}>Morocco</option>
                                        <option value="Mozambique" {{ old('billing_country') == 'Mozambique' ? 'selected' : '' }}>Mozambique</option>
                                        <option value="Namibia" {{ old('billing_country') == 'Namibia' ? 'selected' : '' }}>Namibia</option>
                                        <option value="Nepal" {{ old('billing_country') == 'Nepal' ? 'selected' : '' }}>Nepal</option>
                                        <option value="Netherlands" {{ old('billing_country') == 'Netherlands' ? 'selected' : '' }}>Netherlands</option>
                                        <option value="New Zealand" {{ old('billing_country') == 'New Zealand' ? 'selected' : '' }}>New Zealand</option>
                                        <option value="Nigeria" {{ old('billing_country') == 'Nigeria' ? 'selected' : '' }}>Nigeria</option>
                                        <option value="Norway" {{ old('billing_country') == 'Norway' ? 'selected' : '' }}>Norway</option>
                                        <option value="Oman" {{ old('billing_country') == 'Oman' ? 'selected' : '' }}>Oman</option>
                                        <option value="Pakistan" {{ old('billing_country') == 'Pakistan' ? 'selected' : '' }}>Pakistan</option>
                                        <option value="Philippines" {{ old('billing_country') == 'Philippines' ? 'selected' : '' }}>Philippines</option>
                                        <option value="Poland" {{ old('billing_country') == 'Poland' ? 'selected' : '' }}>Poland</option>
                                        <option value="Portugal" {{ old('billing_country') == 'Portugal' ? 'selected' : '' }}>Portugal</option>
                                        <option value="Qatar" {{ old('billing_country') == 'Qatar' ? 'selected' : '' }}>Qatar</option>
                                        <option value="Romania" {{ old('billing_country') == 'Romania' ? 'selected' : '' }}>Romania</option>
                                        <option value="Russia" {{ old('billing_country') == 'Russia' ? 'selected' : '' }}>Russia</option>
                                        <option value="Rwanda" {{ old('billing_country') == 'Rwanda' ? 'selected' : '' }}>Rwanda</option>
                                        <option value="Saudi Arabia" {{ old('billing_country') == 'Saudi Arabia' ? 'selected' : '' }}>Saudi Arabia</option>
                                        <option value="Senegal" {{ old('billing_country') == 'Senegal' ? 'selected' : '' }}>Senegal</option>
                                        <option value="Serbia" {{ old('billing_country') == 'Serbia' ? 'selected' : '' }}>Serbia</option>
                                        <option value="Singapore" {{ old('billing_country') == 'Singapore' ? 'selected' : '' }}>Singapore</option>
                                        <option value="Slovakia" {{ old('billing_country') == 'Slovakia' ? 'selected' : '' }}>Slovakia</option>
                                        <option value="Slovenia" {{ old('billing_country') == 'Slovenia' ? 'selected' : '' }}>Slovenia</option>
                                        <option value="South Africa" {{ old('billing_country') == 'South Africa' ? 'selected' : '' }}>South Africa</option>
                                        <option value="South Korea" {{ old('billing_country') == 'South Korea' ? 'selected' : '' }}>South Korea</option>
                                        <option value="Spain" {{ old('billing_country') == 'Spain' ? 'selected' : '' }}>Spain</option>
                                        <option value="Sri Lanka" {{ old('billing_country') == 'Sri Lanka' ? 'selected' : '' }}>Sri Lanka</option>
                                        <option value="Sudan" {{ old('billing_country') == 'Sudan' ? 'selected' : '' }}>Sudan</option>
                                        <option value="Sweden" {{ old('billing_country') == 'Sweden' ? 'selected' : '' }}>Sweden</option>
                                        <option value="Switzerland" {{ old('billing_country') == 'Switzerland' ? 'selected' : '' }}>Switzerland</option>
                                        <option value="Syria" {{ old('billing_country') == 'Syria' ? 'selected' : '' }}>Syria</option>
                                        <option value="Tanzania" {{ old('billing_country') == 'Tanzania' ? 'selected' : '' }}>Tanzania</option>
                                        <option value="Thailand" {{ old('billing_country') == 'Thailand' ? 'selected' : '' }}>Thailand</option>
                                        <option value="Tunisia" {{ old('billing_country') == 'Tunisia' ? 'selected' : '' }}>Tunisia</option>
                                        <option value="Turkey" {{ old('billing_country') == 'Turkey' ? 'selected' : '' }}>Turkey</option>
                                        <option value="Uganda" {{ old('billing_country') == 'Uganda' ? 'selected' : '' }}>Uganda</option>
                                        <option value="Ukraine" {{ old('billing_country') == 'Ukraine' ? 'selected' : '' }}>Ukraine</option>
                                        <option value="United Arab Emirates" {{ old('billing_country') == 'United Arab Emirates' ? 'selected' : '' }}>United Arab Emirates</option>
                                        <option value="United Kingdom" {{ old('billing_country') == 'United Kingdom' ? 'selected' : '' }}>United Kingdom</option>
                                        <option value="United States" {{ old('billing_country') == 'United States' ? 'selected' : '' }}>United States</option>
                                        <option value="Uruguay" {{ old('billing_country') == 'Uruguay' ? 'selected' : '' }}>Uruguay</option>
                                        <option value="Uzbekistan" {{ old('billing_country') == 'Uzbekistan' ? 'selected' : '' }}>Uzbekistan</option>
                                        <option value="Venezuela" {{ old('billing_country') == 'Venezuela' ? 'selected' : '' }}>Venezuela</option>
                                        <option value="Vietnam" {{ old('billing_country') == 'Vietnam' ? 'selected' : '' }}>Vietnam</option>
                                        <option value="Yemen" {{ old('billing_country') == 'Yemen' ? 'selected' : '' }}>Yemen</option>
                                        <option value="Zambia" {{ old('billing_country') == 'Zambia' ? 'selected' : '' }}>Zambia</option>
                                        <option value="Zimbabwe" {{ old('billing_country') == 'Zimbabwe' ? 'selected' : '' }}>Zimbabwe</option>
                                    </select>
                            </div>
                            <div class="col-12 mb-20">
                                <label>Street Address <span>*</span></label>
                                <input type="text" name="billing_address" 
                                    value="{{ old('billing_address', Auth::user()->primary_address ? explode(',', Auth::user()->primary_address)[0] : '') }}" 
                                    placeholder="House number and street name" required>
                            </div>
                            <div class="col-12 mb-20">
                                <label>Apartment, suite, unit etc. (optional)</label>
                                <input type="text" name="billing_address2" 
                                    value="{{ old('billing_address2') }}" 
                                    placeholder="Apartment, suite, unit etc.">
                            </div>
                            <div class="col-12 mb-20">
                                <label>Town / City <span>*</span></label>
                                <input type="text" name="billing_city" 
                                    value="{{ old('billing_city') }}" 
                                    required>
                            </div>
                            <div class="col-12 mb-20">
                                <label>State / County <span>*</span></label>
                                <input type="text" name="billing_state" 
                                    value="{{ old('billing_state') }}" 
                                    required>
                            </div>
                            <div class="col-12 mb-20">
                                <label>Postcode / ZIP <span>*</span></label>
                                <input type="text" name="billing_zip_code" 
                                    value="{{ old('billing_zip_code') }}" 
                                    required>
                            </div>
                            <div class="col-12 mb-20">
                                <input id="different_shipping" type="checkbox" name="different_shipping" 
                                    {{ old('different_shipping') ? 'checked' : '' }}>
                                <label for="different_shipping">Ship to a different address?</label>
                            </div>
                            
                            <!-- Shipping Address Fields (hidden by default) -->
                            <div id="shipping_address_fields" style="display: none;">
                                <div class="col-12">
                                    <h4>Shipping Address</h4>
                                </div>
                                <div class="col-lg-6 mb-20">
                                    <label>First Name <span>*</span></label>
                                    <input type="text" name="shipping_first_name" 
                                        value="{{ old('shipping_first_name') }}">
                                </div>
                                <div class="col-lg-6 mb-20">
                                    <label>Last Name <span>*</span></label>
                                    <input type="text" name="shipping_last_name" 
                                        value="{{ old('shipping_last_name') }}">
                                </div>
                                <div class="col-12 mb-20">
                                    <label>Email Address <span>*</span></label>
                                    <input type="email" name="shipping_email" 
                                        value="{{ old('shipping_email') }}">
                                </div>
                                <div class="col-12 mb-20">
                                    <label>Phone <span>*</span></label>
                                    <input type="text" name="shipping_phone" 
                                        value="{{ old('shipping_phone') }}">
                                </div>
                                <div class="col-12 mb-20">
                                    <label>Country <span>*</span></label>
                                    <select class="select_option" name="shipping_country" id="country">
                                        <option value="Nigeria" {{ old('shipping_country') == 'Nigeria' ? 'selected' : '' }}>Nigeria</option>
                                        <option value="Afghanistan" {{ old('shipping_country') == 'Afghanistan' ? 'selected' : '' }}>Afghanistan</option>
                                        <option value="Albania" {{ old('shipping_country') == 'Albania' ? 'selected' : '' }}>Albania</option>
                                        <option value="Algeria" {{ old('shipping_country') == 'Algeria' ? 'selected' : '' }}>Algeria</option>
                                        <option value="Andorra" {{ old('shipping_country') == 'Andorra' ? 'selected' : '' }}>Andorra</option>
                                        <option value="Angola" {{ old('shipping_country') == 'Angola' ? 'selected' : '' }}>Angola</option>
                                        <option value="Argentina" {{ old('shipping_country') == 'Argentina' ? 'selected' : '' }}>Argentina</option>
                                        <option value="Armenia" {{ old('shipping_country') == 'Armenia' ? 'selected' : '' }}>Armenia</option>
                                        <option value="Australia" {{ old('shipping_country') == 'Australia' ? 'selected' : '' }}>Australia</option>
                                        <option value="Austria" {{ old('shipping_country') == 'Austria' ? 'selected' : '' }}>Austria</option>
                                        <option value="Azerbaijan" {{ old('shipping_country') == 'Azerbaijan' ? 'selected' : '' }}>Azerbaijan</option>
                                        <option value="Bahamas" {{ old('shipping_country') == 'Bahamas' ? 'selected' : '' }}>Bahamas</option>
                                        <option value="Bahrain" {{ old('shipping_country') == 'Bahrain' ? 'selected' : '' }}>Bahrain</option>
                                        <option value="Bangladesh" {{ old('shipping_country') == 'Bangladesh' ? 'selected' : '' }}>Bangladesh</option>
                                        <option value="Barbados" {{ old('shipping_country') == 'Barbados' ? 'selected' : '' }}>Barbados</option>
                                        <option value="Belarus" {{ old('shipping_country') == 'Belarus' ? 'selected' : '' }}>Belarus</option>
                                        <option value="Belgium" {{ old('shipping_country') == 'Belgium' ? 'selected' : '' }}>Belgium</option>
                                        <option value="Belize" {{ old('shipping_country') == 'Belize' ? 'selected' : '' }}>Belize</option>
                                        <option value="Benin" {{ old('shipping_country') == 'Benin' ? 'selected' : '' }}>Benin</option>
                                        <option value="Bhutan" {{ old('shipping_country') == 'Bhutan' ? 'selected' : '' }}>Bhutan</option>
                                        <option value="Bolivia" {{ old('shipping_country') == 'Bolivia' ? 'selected' : '' }}>Bolivia</option>
                                        <option value="Bosnia and Herzegovina" {{ old('shipping_country') == 'Bosnia and Herzegovina' ? 'selected' : '' }}>Bosnia and Herzegovina</option>
                                        <option value="Botswana" {{ old('shipping_country') == 'Botswana' ? 'selected' : '' }}>Botswana</option>
                                        <option value="Brazil" {{ old('shipping_country') == 'Brazil' ? 'selected' : '' }}>Brazil</option>
                                        <option value="Brunei" {{ old('shipping_country') == 'Brunei' ? 'selected' : '' }}>Brunei</option>
                                        <option value="Bulgaria" {{ old('shipping_country') == 'Bulgaria' ? 'selected' : '' }}>Bulgaria</option>
                                        <option value="Burkina Faso" {{ old('shipping_country') == 'Burkina Faso' ? 'selected' : '' }}>Burkina Faso</option>
                                        <option value="Burundi" {{ old('shipping_country') == 'Burundi' ? 'selected' : '' }}>Burundi</option>
                                        <option value="Cambodia" {{ old('shipping_country') == 'Cambodia' ? 'selected' : '' }}>Cambodia</option>
                                        <option value="Cameroon" {{ old('shipping_country') == 'Cameroon' ? 'selected' : '' }}>Cameroon</option>
                                        <option value="Canada" {{ old('shipping_country') == 'Canada' ? 'selected' : '' }}>Canada</option>
                                        <option value="Cape Verde" {{ old('shipping_country') == 'Cape Verde' ? 'selected' : '' }}>Cape Verde</option>
                                        <option value="Central African Republic" {{ old('shipping_country') == 'Central African Republic' ? 'selected' : '' }}>Central African Republic</option>
                                        <option value="Chad" {{ old('shipping_country') == 'Chad' ? 'selected' : '' }}>Chad</option>
                                        <option value="Chile" {{ old('shipping_country') == 'Chile' ? 'selected' : '' }}>Chile</option>
                                        <option value="China" {{ old('shipping_country') == 'China' ? 'selected' : '' }}>China</option>
                                        <option value="Colombia" {{ old('shipping_country') == 'Colombia' ? 'selected' : '' }}>Colombia</option>
                                        <option value="Comoros" {{ old('shipping_country') == 'Comoros' ? 'selected' : '' }}>Comoros</option>
                                        <option value="Costa Rica" {{ old('shipping_country') == 'Costa Rica' ? 'selected' : '' }}>Costa Rica</option>
                                        <option value="Croatia" {{ old('shipping_country') == 'Croatia' ? 'selected' : '' }}>Croatia</option>
                                        <option value="Cuba" {{ old('shipping_country') == 'Cuba' ? 'selected' : '' }}>Cuba</option>
                                        <option value="Cyprus" {{ old('shipping_country') == 'Cyprus' ? 'selected' : '' }}>Cyprus</option>
                                        <option value="Czech Republic" {{ old('shipping_country') == 'Czech Republic' ? 'selected' : '' }}>Czech Republic</option>
                                        <option value="Denmark" {{ old('shipping_country') == 'Denmark' ? 'selected' : '' }}>Denmark</option>
                                        <option value="Djibouti" {{ old('shipping_country') == 'Djibouti' ? 'selected' : '' }}>Djibouti</option>
                                        <option value="Dominican Republic" {{ old('shipping_country') == 'Dominican Republic' ? 'selected' : '' }}>Dominican Republic</option>
                                        <option value="Ecuador" {{ old('shipping_country') == 'Ecuador' ? 'selected' : '' }}>Ecuador</option>
                                        <option value="Egypt" {{ old('shipping_country') == 'Egypt' ? 'selected' : '' }}>Egypt</option>
                                        <option value="El Salvador" {{ old('shipping_country') == 'El Salvador' ? 'selected' : '' }}>El Salvador</option>
                                        <option value="Estonia" {{ old('shipping_country') == 'Estonia' ? 'selected' : '' }}>Estonia</option>
                                        <option value="Ethiopia" {{ old('shipping_country') == 'Ethiopia' ? 'selected' : '' }}>Ethiopia</option>
                                        <option value="Fiji" {{ old('shipping_country') == 'Fiji' ? 'selected' : '' }}>Fiji</option>
                                        <option value="Finland" {{ old('shipping_country') == 'Finland' ? 'selected' : '' }}>Finland</option>
                                        <option value="France" {{ old('shipping_country') == 'France' ? 'selected' : '' }}>France</option>
                                        <option value="Germany" {{ old('shipping_country') == 'Germany' ? 'selected' : '' }}>Germany</option>
                                        <option value="Ghana" {{ old('shipping_country') == 'Ghana' ? 'selected' : '' }}>Ghana</option>
                                        <option value="Greece" {{ old('shipping_country') == 'Greece' ? 'selected' : '' }}>Greece</option>
                                        <option value="Hungary" {{ old('shipping_country') == 'Hungary' ? 'selected' : '' }}>Hungary</option>
                                        <option value="Iceland" {{ old('shipping_country') == 'Iceland' ? 'selected' : '' }}>Iceland</option>
                                        <option value="India" {{ old('shipping_country') == 'India' ? 'selected' : '' }}>India</option>
                                        <option value="Indonesia" {{ old('shipping_country') == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                                        <option value="Iran" {{ old('shipping_country') == 'Iran' ? 'selected' : '' }}>Iran</option>
                                        <option value="Iraq" {{ old('shipping_country') == 'Iraq' ? 'selected' : '' }}>Iraq</option>
                                        <option value="Ireland" {{ old('shipping_country') == 'Ireland' ? 'selected' : '' }}>Ireland</option>
                                        <option value="Israel" {{ old('shipping_country') == 'Israel' ? 'selected' : '' }}>Israel</option>
                                        <option value="Italy" {{ old('shipping_country') == 'Italy' ? 'selected' : '' }}>Italy</option>
                                        <option value="Jamaica" {{ old('shipping_country') == 'Jamaica' ? 'selected' : '' }}>Jamaica</option>
                                        <option value="Japan" {{ old('shipping_country') == 'Japan' ? 'selected' : '' }}>Japan</option>
                                        <option value="Jordan" {{ old('shipping_country') == 'Jordan' ? 'selected' : '' }}>Jordan</option>
                                        <option value="Kenya" {{ old('shipping_country') == 'Kenya' ? 'selected' : '' }}>Kenya</option>
                                        <option value="Kuwait" {{ old('shipping_country') == 'Kuwait' ? 'selected' : '' }}>Kuwait</option>
                                        <option value="Latvia" {{ old('shipping_country') == 'Latvia' ? 'selected' : '' }}>Latvia</option>
                                        <option value="Lebanon" {{ old('shipping_country') == 'Lebanon' ? 'selected' : '' }}>Lebanon</option>
                                        <option value="Lithuania" {{ old('shipping_country') == 'Lithuania' ? 'selected' : '' }}>Lithuania</option>
                                        <option value="Luxembourg" {{ old('shipping_country') == 'Luxembourg' ? 'selected' : '' }}>Luxembourg</option>
                                        <option value="Madagascar" {{ old('shipping_country') == 'Madagascar' ? 'selected' : '' }}>Madagascar</option>
                                        <option value="Malaysia" {{ old('shipping_country') == 'Malaysia' ? 'selected' : '' }}>Malaysia</option>
                                        <option value="Maldives" {{ old('shipping_country') == 'Maldives' ? 'selected' : '' }}>Maldives</option>
                                        <option value="Mali" {{ old('shipping_country') == 'Mali' ? 'selected' : '' }}>Mali</option>
                                        <option value="Malta" {{ old('shipping_country') == 'Malta' ? 'selected' : '' }}>Malta</option>
                                        <option value="Mexico" {{ old('shipping_country') == 'Mexico' ? 'selected' : '' }}>Mexico</option>
                                        <option value="Monaco" {{ old('shipping_country') == 'Monaco' ? 'selected' : '' }}>Monaco</option>
                                        <option value="Mongolia" {{ old('shipping_country') == 'Mongolia' ? 'selected' : '' }}>Mongolia</option>
                                        <option value="Morocco" {{ old('shipping_country') == 'Morocco' ? 'selected' : '' }}>Morocco</option>
                                        <option value="Mozambique" {{ old('shipping_country') == 'Mozambique' ? 'selected' : '' }}>Mozambique</option>
                                        <option value="Namibia" {{ old('shipping_country') == 'Namibia' ? 'selected' : '' }}>Namibia</option>
                                        <option value="Nepal" {{ old('shipping_country') == 'Nepal' ? 'selected' : '' }}>Nepal</option>
                                        <option value="Netherlands" {{ old('shipping_country') == 'Netherlands' ? 'selected' : '' }}>Netherlands</option>
                                        <option value="New Zealand" {{ old('shipping_country') == 'New Zealand' ? 'selected' : '' }}>New Zealand</option>
                                        <option value="Nigeria" {{ old('shipping_country') == 'Nigeria' ? 'selected' : '' }}>Nigeria</option>
                                        <option value="Norway" {{ old('shipping_country') == 'Norway' ? 'selected' : '' }}>Norway</option>
                                        <option value="Oman" {{ old('shipping_country') == 'Oman' ? 'selected' : '' }}>Oman</option>
                                        <option value="Pakistan" {{ old('shipping_country') == 'Pakistan' ? 'selected' : '' }}>Pakistan</option>
                                        <option value="Philippines" {{ old('shipping_country') == 'Philippines' ? 'selected' : '' }}>Philippines</option>
                                        <option value="Poland" {{ old('shipping_country') == 'Poland' ? 'selected' : '' }}>Poland</option>
                                        <option value="Portugal" {{ old('shipping_country') == 'Portugal' ? 'selected' : '' }}>Portugal</option>
                                        <option value="Qatar" {{ old('shipping_country') == 'Qatar' ? 'selected' : '' }}>Qatar</option>
                                        <option value="Romania" {{ old('shipping_country') == 'Romania' ? 'selected' : '' }}>Romania</option>
                                        <option value="Russia" {{ old('shipping_country') == 'Russia' ? 'selected' : '' }}>Russia</option>
                                        <option value="Rwanda" {{ old('shipping_country') == 'Rwanda' ? 'selected' : '' }}>Rwanda</option>
                                        <option value="Saudi Arabia" {{ old('shipping_country') == 'Saudi Arabia' ? 'selected' : '' }}>Saudi Arabia</option>
                                        <option value="Senegal" {{ old('shipping_country') == 'Senegal' ? 'selected' : '' }}>Senegal</option>
                                        <option value="Serbia" {{ old('shipping_country') == 'Serbia' ? 'selected' : '' }}>Serbia</option>
                                        <option value="Singapore" {{ old('shipping_country') == 'Singapore' ? 'selected' : '' }}>Singapore</option>
                                        <option value="Slovakia" {{ old('shipping_country') == 'Slovakia' ? 'selected' : '' }}>Slovakia</option>
                                        <option value="Slovenia" {{ old('shipping_country') == 'Slovenia' ? 'selected' : '' }}>Slovenia</option>
                                        <option value="South Africa" {{ old('shipping_country') == 'South Africa' ? 'selected' : '' }}>South Africa</option>
                                        <option value="South Korea" {{ old('shipping_country') == 'South Korea' ? 'selected' : '' }}>South Korea</option>
                                        <option value="Spain" {{ old('shipping_country') == 'Spain' ? 'selected' : '' }}>Spain</option>
                                        <option value="Sri Lanka" {{ old('shipping_country') == 'Sri Lanka' ? 'selected' : '' }}>Sri Lanka</option>
                                        <option value="Sudan" {{ old('shipping_country') == 'Sudan' ? 'selected' : '' }}>Sudan</option>
                                        <option value="Sweden" {{ old('shipping_country') == 'Sweden' ? 'selected' : '' }}>Sweden</option>
                                        <option value="Switzerland" {{ old('shipping_country') == 'Switzerland' ? 'selected' : '' }}>Switzerland</option>
                                        <option value="Syria" {{ old('shipping_country') == 'Syria' ? 'selected' : '' }}>Syria</option>
                                        <option value="Tanzania" {{ old('shipping_country') == 'Tanzania' ? 'selected' : '' }}>Tanzania</option>
                                        <option value="Thailand" {{ old('shipping_country') == 'Thailand' ? 'selected' : '' }}>Thailand</option>
                                        <option value="Tunisia" {{ old('shipping_country') == 'Tunisia' ? 'selected' : '' }}>Tunisia</option>
                                        <option value="Turkey" {{ old('shipping_country') == 'Turkey' ? 'selected' : '' }}>Turkey</option>
                                        <option value="Uganda" {{ old('shipping_country') == 'Uganda' ? 'selected' : '' }}>Uganda</option>
                                        <option value="Ukraine" {{ old('shipping_country') == 'Ukraine' ? 'selected' : '' }}>Ukraine</option>
                                        <option value="United Arab Emirates" {{ old('shipping_country') == 'United Arab Emirates' ? 'selected' : '' }}>United Arab Emirates</option>
                                        <option value="United Kingdom" {{ old('shipping_country') == 'United Kingdom' ? 'selected' : '' }}>United Kingdom</option>
                                        <option value="United States" {{ old('shipping_country') == 'United States' ? 'selected' : '' }}>United States</option>
                                        <option value="Uruguay" {{ old('shipping_country') == 'Uruguay' ? 'selected' : '' }}>Uruguay</option>
                                        <option value="Uzbekistan" {{ old('shipping_country') == 'Uzbekistan' ? 'selected' : '' }}>Uzbekistan</option>
                                        <option value="Venezuela" {{ old('shipping_country') == 'Venezuela' ? 'selected' : '' }}>Venezuela</option>
                                        <option value="Vietnam" {{ old('shipping_country') == 'Vietnam' ? 'selected' : '' }}>Vietnam</option>
                                        <option value="Yemen" {{ old('shipping_country') == 'Yemen' ? 'selected' : '' }}>Yemen</option>
                                        <option value="Zambia" {{ old('shipping_country') == 'Zambia' ? 'selected' : '' }}>Zambia</option>
                                        <option value="Zimbabwe" {{ old('shipping_country') == 'Zimbabwe' ? 'selected' : '' }}>Zimbabwe</option>
                                    </select>
                                    
                                </div>
                                <div class="col-12 mb-20">
                                    <label>Street Address <span>*</span></label>
                                    <input type="text" name="shipping_address" 
                                        value="{{ old('shipping_address') }}" 
                                        placeholder="House number and street name">
                                </div>
                                <div class="col-12 mb-20">
                                    <label>Apartment, suite, unit etc. (optional)</label>
                                    <input type="text" name="shipping_address2" 
                                        value="{{ old('shipping_address2') }}" 
                                        placeholder="Apartment, suite, unit etc.">
                                </div>
                                <div class="col-12 mb-20">
                                    <label>Town / City <span>*</span></label>
                                    <input type="text" name="shipping_city" 
                                        value="{{ old('shipping_city') }}">
                                </div>
                                <div class="col-12 mb-20">
                                    <label>State / County <span>*</span></label>
                                    <input type="text" name="shipping_state" 
                                        value="{{ old('shipping_state') }}">
                                </div>
                                <div class="col-12 mb-20">
                                    <label>Postcode / ZIP <span>*</span></label>
                                    <input type="text" name="shipping_zip_code" 
                                        value="{{ old('shipping_zip_code') }}">
                                </div>
                            </div>
                            
                            <div class="col-12 mb-20">
                                <input id="save_shipping" type="checkbox" name="save_shipping" value="1" 
                                    {{ old('save_shipping') ? 'checked' : '' }}>
                                <label for="save_shipping">Save shipping address to my profile</label>
                            </div>
                            
                            <div class="col-12">
                                <div class="order-notes">
                                    <label for="order_note">Order Notes</label>
                                    <textarea id="order_note" name="notes" placeholder="Notes about your order, e.g. special notes for delivery.">{{ old('notes') }}</textarea>
                                </div>    
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <h3>Your order</h3> 
                        <div class="order_table table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cart->items as $item)
                                        <tr>
                                            <td>{{ $item->product->name }} 
                                                @if($item->size)<strong> (Size: {{ $item->size }})</strong>@endif
                                                @if($item->color)<strong> (Color: {{ $item->color }})</strong>@endif
                                                <strong> × {{ $item->quantity }}</strong>
                                            </td>
                                            <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Cart Subtotal</th>
                                        <td>${{ number_format($cart->subtotal, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Shipping</th>
                                        <td><strong>${{ number_format($cart->shipping, 2) }}</strong></td>
                                    </tr>
                                    <tr class="order_total">
                                        <th>Order Total</th>
                                        <td><strong>${{ number_format($cart->total, 2) }}</strong></td>
                                    </tr>
                                </tfoot>
                            </table>     
                        </div>
                        <div class="payment_method">
                            <h3>Payment</h3>
                            
                            <!-- DEBUG: Check if variable exists
                            <div style="background: #f8f9fa; padding: 10px; margin-bottom: 15px; border: 1px solid #ddd;">
                                <strong>Debug Info:</strong><br>
                                Payment Methods Variable Exists: {{ isset($paymentMethods) ? 'YES' : 'NO' }}<br>
                                Payment Methods Count: {{ isset($paymentMethods) ? count($paymentMethods) : 0 }}<br>
                                @if(isset($paymentMethods) && count($paymentMethods) > 0)
                                    First Method: {{ $paymentMethods[0]->name }}<br>
                                    All Methods: 
                                    @foreach($paymentMethods as $method)
                                        {{ $method->name }}, 
                                    @endforeach
                                @endif
                            </div> -->
                            <br>
                            <p><strong>Select your preferred payment method:</strong></p>
                                        <br>
                            @if(isset($paymentMethods) && count($paymentMethods) > 0)
                                @foreach($paymentMethods as $method)
                                    <div class="panel-default">
                                        
                                        <input id="payment_{{ $method->id }}" name="payment_method" type="radio" value="{{ $method->id }}" 
                                            {{ old('payment_method') == $method->id ? 'checked' : ($loop->first ? 'checked' : '') }} required>
                                        <label for="payment_{{ $method->id }}">{{ $method->name }}</label>
                                        <div class="card-body1">
                                            <p>
                                                @if($method->account_name)
                                                    Account: {{ $method->account_name }}<br>
                                                @endif
                                                @if($method->account_number)
                                                    Number: {{ $method->account_number }}<br>
                                                @endif
                                                @if($method->bank_name)
                                                    Bank: {{ $method->bank_name }}<br>
                                                @endif
                                                {{ $method->description ?? 'Secure payment' }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="alert alert-warning">
                                    No payment methods available. Please contact administrator.
                                </div>
                            @endif
                            
                            <br>
                            <div class="order_button">
                                <button type="submit" id="place-order-btn">Place Order</button> 
                            </div>    
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>       
</div>
<!--Checkout page section end-->
@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Toggle shipping address fields
    const differentShippingCheckbox = document.getElementById('different_shipping');
    const shippingAddressFields = document.getElementById('shipping_address_fields');
    
    differentShippingCheckbox.addEventListener('change', function() {
        shippingAddressFields.style.display = this.checked ? 'block' : 'none';
        
        // Make shipping address fields required if checked
        const shippingInputs = shippingAddressFields.querySelectorAll('input, select');
        shippingInputs.forEach(input => {
            input.required = this.checked;
        });
    });

    // Trigger change event on page load in case checkbox was checked before
    if (differentShippingCheckbox.checked) {
        differentShippingCheckbox.dispatchEvent(new Event('change'));
    }

    // Form validation
    const form = document.getElementById('checkout-form');
    const placeOrderBtn = document.getElementById('place-order-btn');
    
    form.addEventListener('submit', function(e) {
        placeOrderBtn.disabled = true;
        placeOrderBtn.textContent = 'Processing...';
    });
});
</script>
@endsection