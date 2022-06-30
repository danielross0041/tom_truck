<?php
$fb = App\Models\config::where('is_active',1)->where('type','facebooklink')->first();
$ins = App\Models\config::where('is_active',1)->where('type','instagramlink')->first();
$yt = App\Models\config::where('is_active',1)->where('type','youtubelink')->first();
$tw = App\Models\config::where('is_active',1)->where('type','twitterlink')->first();
$logo = App\Models\logo::where('is_active',1)->orderBy('id','desc')->first();
?>
<div class="container">
    <div class="footer-top">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4">
                <div class="footer-logo-area">
                    <img src="{{asset($logo->image)}}" alt="logo" class="img-fluid" />
                    <?php echo (html_entity_decode(Helper::editck('p', '', 'Lorem IpFootersum is simply dummy text of the printing and typesetting industry.' ,'pFooterLorem Ipsum is simply dummy text of the printing and typesetting industry.')));?>
                    <!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p> -->
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-5 col-xl-5 col-xxl-5">
                <div class="footer-news-letter">
                    <h4>Subscribe To NewsLetter</h4>
                    <form>
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Enter your email address" />
                            <button class="subscribe-btn">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 col-xxl-3">
                <div class="footer-social-links">
                    <h4>Follow Us</h4>
                    <ul>
                        <li>
                            <a href="{{$fb->value}}"><i class="fab fa-facebook-f"></i></a>
                        </li>
                        <li>
                            <a href="{{$tw->value}}"><i class="fab fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="{{$ins->value}}"><i class="fab fa-instagram"></i></a>
                        </li>
                        <li>
                            <a href="{{$yt->value}}"><i class="fab fa-youtube"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-middle">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 col-xxl-3">
                <div class="footer-info-area">
                    <h4>Contact Us</h4>
                    <ul>
                        <li><p>021 Hollywood Boulevard, LA</p></li>
                        <li><a href="#">info@gmail.com</a></li>
                        <li><a href="#">+1 (23)-456-789</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 col-xxl-3">
                <div class="footer-info-area">
                    <h4>Services</h4>
                    <ul>
                        <li><a href="#">Cargo Tucks</a></li>
                        <li><a href="#">Toe Trucks</a></li>
                        <li><a href="#">Peterbilt Trucks</a></li>
                        <li><a href="#">Book Online</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 col-xxl-3">
                <div class="footer-info-area">
                    <h4>Quick Menu</h4>
                    <ul>
                        <li><a href="{{route('about')}}">About</a></li>
                        <li><a href="{{route('services')}}">Services</a></li>
                        <li><a href="#">Location</a></li>
                        <li><a href="#">Fleet</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 col-xxl-3">
                <div class="footer-info-area">
                    <h4>Customer Services</h4>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Inquiry Form</a></li>
                        <li><a href="#">Testimonials</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                <p>Copyright © <?php echo date("Y");?>. All rights reserved.<a href="#"></a></p>
            </div>
        </div>
    </div>
</div>
