@extends('web.layouts.main')
@section('content')
<main>
    <section class="inner-banner-wrap inner-banner-bg">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="inner-banner-content">
                        <span class="new-span">Sellers</span>
                        <!-- <h2>Sellers</h2> -->
                        <?php echo (html_entity_decode(Helper::editck('h2', '', 'Sellers' ,'h2Sellers')));?>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="inner-banner-breadcrumb">
                        <ul>
                            <li><i class="fas fa-home"></i> <a href="#">Home</a></li>
                            <li><i class="fas fa-angle-right"></i> <span>Sellers</span></li>
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
                        <span class="new-span">Sellers</span>
                        <!-- <h2>Sell Your Trucks</h2> -->

                        <?php echo (html_entity_decode(Helper::editck('h2', '', 'Sell Your Trucks' ,'h2Sell Your Trucks')));?>
                        <?php echo (html_entity_decode(Helper::editck('p', '', 'Sell Your TrucksLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the' ,'h2Sell Your TrucksLoreIpsum is py dummy textof tntin and typsetting tryLorem Iphas be the')));?>
                        <!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s.</p>
                        <p>when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p> -->
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="sellers-form">
                        <form action="#">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                    <div class="form-group">
                                        <input type="text" name="first-name" placeholder="First Name">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                    <div class="form-group">
                                        <input type="text" name="last-name" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                    <div class="form-group">
                                        <input type="email" name="email" placeholder="Your Email">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                    <div class="form-group">
                                        <input type="phone" name="phone" placeholder="Phone">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                    <div class="form-group">
                                        <textarea name="message" placeholder="Message"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                    <div class="form-group">
                                        <button class="send-btn">Send</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
@endsection