@extends('web.layouts.main')
@section('content')

<?php
$mp = App\Models\config::where('is_active',1)->where('type','maplink')->first();
?>
<main>
    <section class="inner-banner-wrap inner-banner-bg">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="inner-banner-content">
                        <span class="new-span">Contact</span>
                        <!-- <h2>Contact Us</h2> -->
                        <?php echo (html_entity_decode(Helper::editck('h2', '', 'Contact Us' ,'h2Contact Us')));?>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="inner-banner-breadcrumb">
                        <ul>
                            <li><i class="fas fa-home"></i> <a href="#">Home</a></li>
                            <li><i class="fas fa-angle-right"></i> <span>Contact</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>    
    </section>

    <section class="contactus-sec-wrap">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="contact-us-content">
                        <span class="new-span">Contact Us</span>
                        <h2>Get In Touch</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s</p>
                    </div>
                    <div class="contact-us-form">
                        <h4>Send Us Message</h4>
                        <form action="{{route('contact_submit')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                    <div class="form-group">
                                        <input type="text" name="name" placeholder="Your Name" required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                    <div class="form-group">
                                        <input type="email" name="email" placeholder="Your Email" required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                    <div class="form-group">
                                        <input type="text" name="subject" placeholder="Subject" required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                    <div class="form-group">
                                        <textarea name="message" placeholder="Message" required></textarea>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                    <div class="form-group">
                                        <button class="submit-btn">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="contact-us-map">
                        <iframe src="{{$mp->value}}" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-info-sec">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                    <div class="contact-info-box">
                        <i class="fas fa-map-marker-alt"></i>
                        <h4>Address</h4>
                        <p>021 Hollywood Boulevard, LA</p>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                    <div class="contact-info-box">
                        <i class="fas fa-envelope"></i>
                        <h4>Email</h4>
                        <a href="#">info@gmail.com</a>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                    <div class="contact-info-box">
                        <i class="fas fa-phone-alt"></i>
                        <h4>Phone</h4>
                        <a href="#">+1 (23) 456-789</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection