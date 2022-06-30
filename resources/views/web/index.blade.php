@extends('web.layouts.main')
@section('content')
<main>
    <section class="main-banner-wrap banner-img-bg">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                    <div class="main-banner-content">
                        <span class="new-span">Welcome To</span>
                        <!-- <h2>One-Stop Truck Service</h2> -->
                        <?php echo (html_entity_decode(Helper::editck('h2', '', 'One-Stop Truck Service' ,'h2One-Stop Truck Service')));?>
                        <!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p> -->
                        <?php echo (html_entity_decode(Helper::editck('p', '', 'Lorem Ipsum is simply dummy text of the printing' ,'pLoreIpsumsimpdummytexof printing')));?>
                        <a href="" class="learn-more-btn">Learn More <i class="fas fa-chevron-double-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="delivery-sec-wrap">
        <div class="container">
            <div class="delivery-support-items">
                <div class="deliver-item-box">
                    <i class="fas fa-plane"></i>
                    <h4>Airport Delivery</h4>
                    <?php echo (html_entity_decode(Helper::editck('p', '', 'Lorem Ipsum is simply dummy text of the printing' ,'pAirport DeliveryLorem Ipsum is simply dummy text of the printing')));?>
                    <!-- <p>Lorem Ipsum is simply dummy text of the printing</p> -->
                </div>
                <div class="deliver-item-box">
                    <i class="fas fa-headphones"></i>
                    <h4>24/7 Support</h4>
                    <!-- <p>Lorem Ipsum is simply dummy text of the printing</p> -->
                    <?php echo (html_entity_decode(Helper::editck('p', '', 'Lorem Ipsum is simply dummy text of the printing' ,'p24/7 SupportLorem Ipsum is simply dummy text of the printing')));?>
                </div>
            </div>
        </div>
    </section>

    <section class="fleet-sec-wrap">
        <div class="container">
            <div class="section-head">
                <span class="new-span">Fleet</span>
                <!-- <h2>Best our Fleet</h2> -->
                <?php echo (html_entity_decode(Helper::editck('h2', '', 'Best our Fleet' ,'h2Best our Fleet')));?>
                <!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p> -->
                <?php echo (html_entity_decode(Helper::editck('p', '', 'Lorem Ipsum is simply dummy text of the printing' ,'pBest our FleetLorem Ipsum is simply dummy text of the printing')));?>
            </div>
            <div class="row">
                @foreach($products as $product)
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-4 col-xxl-4">
                    <div class="fleet-item-box">
                        <div class="fleet-item-head">
                            <h6>Electric | ON-Highway</h6>
                            <h4>{{$product->name}}</h4>
                        </div>
                        <div class="fleet-item-price">
                            <span>
                                From
                                <strong>${{$product->price}}</strong>
                            </span>
                            <a href="{{route('product_list',$product->id)}}" class="book-now-btn">Book Now</a>
                        </div>
                        <div class="fleet-item-img">
                            <a href="#"><img src="{{asset('web/images/fleet-img1.png')}}" alt="img" class="img-fluid"></a>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-4 col-xxl-4">
                    <div class="fleet-item-box">
                        <div class="fleet-item-head">
                            <h6>Electric | Medium Duty</h6>
                            <h4>EM2</h4>
                        </div>
                        <div class="fleet-item-price">
                            <span>
                                From
                                <strong>$1000.00</strong>
                            </span>
                            <a href="#" class="book-now-btn">Book Now</a>
                        </div>
                        <div class="fleet-item-img">
                            <a href="#"><img src="{{asset('web/images/fleet-img2.png')}}" alt="img" class="img-fluid"></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-4 col-xxl-4">
                    <div class="fleet-item-box">
                        <div class="fleet-item-head">
                            <h6>ON-Highway</h6>
                            <h4>CASCADIA</h4>
                        </div>
                        <div class="fleet-item-price">
                            <span>
                                From
                                <strong>$1000.00</strong>
                            </span>
                            <a href="#" class="book-now-btn">Book Now</a>
                        </div>
                        <div class="fleet-item-img">
                            <a href="#"><img src="{{asset('web/images/fleet-img3.png')}}" alt="img" class="img-fluid"></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-4 col-xxl-4">
                    <div class="fleet-item-box">
                        <div class="fleet-item-head">
                            <h6>Medium Duty</h6>
                            <h4>M2 106</h4>
                        </div>
                        <div class="fleet-item-price">
                            <span>
                                From
                                <strong>$1000.00</strong>
                            </span>
                            <a href="#" class="book-now-btn">Book Now</a>
                        </div>
                        <div class="fleet-item-img">
                            <a href="#"><img src="{{asset('web/images/fleet-img4.png')}}" alt="img" class="img-fluid"></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-4 col-xxl-4">
                    <div class="fleet-item-box">
                        <div class="fleet-item-head">
                            <h6>ON-Highway |  Severe Duty</h6>
                            <h4>122SD</h4>
                        </div>
                        <div class="fleet-item-price">
                            <span>
                                From
                                <strong>$1000.00</strong>
                            </span>
                            <a href="#" class="book-now-btn">Book Now</a>
                        </div>
                        <div class="fleet-item-img">
                            <a href="#"><img src="{{asset('web/images/fleet-img5.png')}}" alt="img" class="img-fluid"></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-4 col-xxl-4">
                    <div class="fleet-item-box">
                        <div class="fleet-item-head">
                            <h6>Severe Duty</h6>
                            <h4>108SD</h4>
                        </div>
                        <div class="fleet-item-price">
                            <span>
                                From
                                <strong>$1000.00</strong>
                            </span>
                            <a href="#" class="book-now-btn">Book Now</a>
                        </div>
                        <div class="fleet-item-img">
                            <a href="#"><img src="{{asset('web/images/fleet-img6.png')}}" alt="img" class="img-fluid"></a>
                        </div>
                    </div>
                </div> -->
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                    <div class="view-more-fleet">
                        <a href="{{route('product')}}" class="view-more-btn">View More Fleet <i class="fas fa-chevron-double-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="location-sec-wrap">
        <div class="container">
            <div class="location-bg-img">
                <div class="section-head">
                    <span>Locations</span>
                    <!-- <h2>Our Locations</h2> -->
                    <?php echo (html_entity_decode(Helper::editck('h2', '', 'Our Locations' ,'h2Our Locations')));?>
                    <?php echo (html_entity_decode(Helper::editck('p', '', 'Our Locations' ,'pOur LocationsLoremIsum simpldutextoftheprintinga')));?>
                    <!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p> -->
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                        <div class="location-content-img">
                            <img src="{{asset('web/images/location-img.png')}}" alt="img" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
                        <div class="location-item-box">
                            <h4><i class="fas fa-map-marker-alt"></i> Dallas</h4>
                            <p>1234 Duchess Boulevard, 6A</p>
                            <a href="#" class="view-location-btn">View Location <i class="fas fa-chevron-double-right"></i></a>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
                        <div class="location-item-box">
                            <h4><i class="fas fa-map-marker-alt"></i> Burlingame</h4>
                            <p>1234 Duchess Boulevard, 6A</p>
                            <a href="#" class="view-location-btn">View Location <i class="fas fa-chevron-double-right"></i></a>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
                        <div class="location-item-box">
                            <h4><i class="fas fa-map-marker-alt"></i> Burlingame</h4>
                            <p>1234 Duchess Boulevard, 6A</p>
                            <a href="#" class="view-location-btn">View Location <i class="fas fa-chevron-double-right"></i></a>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
                        <div class="location-item-box">
                            <h4><i class="fas fa-map-marker-alt"></i> Austin</h4>
                            <p>1234 Duchess Boulevard, 6A</p>
                            <a href="#" class="view-location-btn">View Location <i class="fas fa-chevron-double-right"></i></a>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                        <div class="location-reviews-items">
                            <div class="review-nmbr-item">
                                <h4>52 <span>+</span></h4>
                                <p>Locations</p>
                            </div>
                            <div class="review-nmbr-item">
                                <h4>40 <span>+</span></h4>
                                <p>States</p>
                            </div>
                            <div class="review-nmbr-item">
                                <h4>100 <span>+</span></h4>
                                <p>Vehicle Types</p>
                            </div>
                            <div class="review-nmbr-item">
                                <h4>150K <span>+</span></h4>
                                <p>Customers</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="aboutus-sec-wrap">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="about-us-content">
                        <span class="new-span">About Us</span>
                        <!-- <h2>About Our Company</h2> -->
                        <?php echo (html_entity_decode(Helper::editck('h2', '', 'About Our Company' ,'h2About Our Company')));?>
                        <!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>

                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s</p> -->
                        <?php echo (html_entity_decode(Helper::editck('p', '', 'About Our CompanyLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown ' ,'pAbout OrCompnLomIpsu isimply dumtextotprintingandtypesettingindustr Lobeetheindustry’sstandardummtexeversint1500swhenaunknown')));?>
                        <div class="about-founder-info">
                            <img src="{{asset('web/images/about-thumb1.jpg')}}" alt="thumb" class="img-fluid">
                            <div class="founder-info-text">
                                <h6>Peter Wilkinson</h6>
                                <p>Founder</p>
                            </div>
                        </div>
                        <a href="#" class="learn-more-btn">learn More</a>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="book-with-bg">
                        <div class="book-with-content">
                            <span class="new-span">Why</span>
                            <!-- <h2>Why Book With Us?</h2> -->
                            <?php echo (html_entity_decode(Helper::editck('h2', '', 'Why Book With Us?' ,'h2Why Book With Us?')));?>
                            <div class="book-content-item">
                                <i class="fas fa-money-bill-alt"></i>
                                <h6>ALL INCLUSIVE PRICING</h6>
                                <?php echo (html_entity_decode(Helper::editck('p', '', 'Lorem Ipsum is simply dummy text of the printing' ,'pALL INCLUSIVE PRICINGLorem Ipsum is simply dummy text of the printing')));?>
                                <!-- <p>Lorem Ipsum is simply dummy text of the printing</p> -->
                            </div>
                            <div class="book-content-item">
                                <i class="fas fa-headphones"></i>
                                <h6>DEDICATED CUSTOMER SUPPORT</h6>
                                <?php echo (html_entity_decode(Helper::editck('p', '', 'Lorem Ipsum is simply dummy text of the printing' ,'pDEDICATED CUSTOMER SUPPORTLorem Ipsum is simply dummy text of the printing')));?>
                                <!-- <p>Lorem Ipsum is simply dummy text of the printing</p> -->
                            </div>
                            <div class="book-content-item">
                                <i class="fas fa-dollar-sign"></i>
                                <h6>LOWEST PRICE GUARANTEE</h6>
                                <?php echo (html_entity_decode(Helper::editck('p', '', 'Lorem Ipsum is simply dummy text of the printing' ,'pLOWEST PRICE GUARANTEELorem Ipsum is simply dummy text of the printing')));?>
                                <!-- <p>Lorem Ipsum is simply dummy text of the printing</p> -->
                            </div>
                            <div class="book-content-item">
                                <i class="far fa-check-double"></i>
                                <h6>FREE CANCELLATION</h6>
                                <?php echo (html_entity_decode(Helper::editck('p', '', 'Lorem Ipsum is simply dummy text of the printing' ,'pFREE CANCELLATIONLorem Ipsum is simply dummy text of the printing')));?>
                                <!-- <p>Lorem Ipsum is simply dummy text of the printing</p> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{--
    <section class="services-sec-wrap">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="services-content">
                        <span class="new-span">Services</span>
                        <!-- <h2>Our Services</h2> -->
                        <?php echo (html_entity_decode(Helper::editck('h2', '', 'Our Services' ,'h2Our Services')));?>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="services-content">
                        <?php echo (html_entity_decode(Helper::editck('p', '', 'Our Servicesorem Ipsum is simply dummy text of the printing and typese' ,'pOur Servicesore Ipsu is simpl dumy tet fthe pitng ad typese')));?>
                        <!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p> -->
                    </div>
                </div>
            </div>
            <div class="services-box-items">
                <div class="row align-items-center">
                    @foreach($services as $service)
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4">
                        <div class="services-content-box">
                           <img src="{{asset($service->image)}}" alt="img" class="img-fluid">
                           <h4>{{$service->title}}</h4>
                           <p>{!! \Illuminate\Support\Str::limit($service->desc, 84, $end='...') !!}</p>
                            <a href="{{route('services_detail',$service->id)}}" class="learn-more-btn">Learn More</a>
                        </div>
                    </div>
                    @endforeach
                    <!-- <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4">
                        <div class="services-content-box">
                           <img src="{{asset('web/images/service-img2.png')}}" alt="img" class="img-fluid">
                           <h4>Toe Truck</h4>
                           <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            <a href="#" class="learn-more-btn">Learn More</a>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4">
                        <div class="services-content-box">
                           <img src="{{asset('web/images/services-3.jpg')}}" alt="img" class="img-fluid">
                           <h4>PETERBILT</h4>
                           <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            <a href="#" class="learn-more-btn">Learn More</a>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </section>
    --}}

    <section class="ourpatner-sec-wrap">
        <div class="container">
            <div class="section-head">
                <span>Patners</span>
                <!-- <h2>Our Patners</h2> -->
                <?php echo (html_entity_decode(Helper::editck('h2', '', 'Our Patners' ,'h2Our Patners')));?>
                <?php echo (html_entity_decode(Helper::editck('p', '', 'Our PatnersLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s' ,'pOur PanersLorem Ipsum simply ummy text of the nting and typesing indusr Ipsum has been usmmy textince the0s')));?>
                <!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p> -->
            </div>
            <div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
                    <a href="#">
                        <img src="{{asset('web/images/patners1.png')}}" alt="img" class="img-fluid">
                    </a>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
                    <a href="#">
                        <img src="{{asset('web/images/patners2.png')}}" alt="img" class="img-fluid">
                    </a>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
                    <a href="#">
                        <img src="{{asset('web/images/patners3.png')}}" alt="img" class="img-fluid">
                    </a>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
                    <a href="#">
                        <img src="{{asset('web/images/patners4.png')}}" alt="img" class="img-fluid">
                    </a>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
                    <a href="#">
                        <img src="{{asset('web/images/patner5.png')}}" alt="img" class="img-fluid">
                    </a>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
                    <a href="#">
                        <img src="{{asset('web/images/patners6.png')}}" alt="img" class="img-fluid">
                    </a>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
                    <a href="#">
                        <img src="{{asset('web/images/patners7.png')}}" alt="img" class="img-fluid">
                    </a>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
                    <a href="#">
                        <img src="{{asset('web/images/patners8.png')}}" alt="img" class="img-fluid">
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="testimonial-sec-wrap testimonial-bg">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="testimonial-head">
                        <div class="testimoinial-info">
                            <span class="new-span">Testimonials</span>
                            <!-- <h4>What People Say!</h4> -->
                            <?php echo (html_entity_decode(Helper::editck('h4', '', 'What People Say!' ,'h4What People Say!')));?>
                            <?php echo (html_entity_decode(Helper::editck('p', '', 'What People Say!Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s' ,'pWhat PeoplLorem Ipsum is simply dummy text of the printing and esetting industry. Lorem Ipsum has been thestrysstandarddummytext he500s')));?>
                            <!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p> -->
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="testimonial-head">
                        <div class="testimonial-head-btn">
                            <a href="#" class="more-review-btn">More Reviews</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="testimonials-box-items">
                <div class="testi-slider">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4">
                        <div class="testimonial-item-box">
                            <i class="fas fa-quote-right"></i>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                            <ul>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                            </ul>
                            <img src="{{asset('web/images/testi-thumb.jpg')}}" alt="img" class="img-fluid">
                            <h4>Peter Hervey</h4>
                            <span>Business</span>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4">
                        <div class="testimonial-item-box active">
                            <i class="fas fa-quote-right"></i>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                            <ul>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                            </ul>
                            <img src="{{asset('web/images/testi-thumb2.jpg')}}" alt="img" class="img-fluid">
                            <h4>Adam Davis</h4>
                            <span>Business</span>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4">
                        <div class="testimonial-item-box">
                            <i class="fas fa-quote-right"></i>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                            <ul>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                            </ul>
                            <img src="{{asset('web/images/testi-thumb3.jpg')}}" alt="img" class="img-fluid">
                            <h4>Alice Davis</h4>
                            <span>Business</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--
    <section class="latest-news-sec">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4">
                    <div class="latest-news-head">
                        <div class="latest-news-info">
                            <span class="new-span">Updates</span>
                            <!-- <h4>Latest News</h4> -->
                            <?php echo (html_entity_decode(Helper::editck('h4', '', 'Latest News' ,'h4Latest News')));?>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="latest-news-head">
                        <div class="latest-news-info">
                            <?php echo (html_entity_decode(Helper::editck('p', '', 'Lorem Ipsum is simply dummy text of the printing and types' ,'pLoem psm isimly ummtext ofh prig and types')));?>
                            <!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p> -->
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2 col-xxl-2">
                    <div class="latest-news-head">
                        <div class="latestnews-head-btn">
                            <a href="#" class="view-all-btn">View All</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($blogs as $blog)
                <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4">
                    <div class="latest-news-box">
                        <img src="{{asset($blog->image)}}" alt="img" class="img-fluid">
                        <div class="news-box-content">
                            <h4>{{$blog->title}}</h4>
                            <p>{{date("M d,Y" ,strtotime($blog->created_at))}}</p>
                            <a href="{{route('blog_detail',$blog->id)}}" class="read-more-btn">Read More <i class="fas fa-chevron-double-right"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4">
                    <div class="latest-news-box">
                        <img src="{{asset('web/images/news-img2.png')}}" alt="img" class="img-fluid">
                        <div class="news-box-content">
                            <h4>LOREM IPSUM IS SIMPLY DUMMY TEXT OF THE PRINTING AND TYPESETTING</h4>
                            <p>April 22, 2022 No Comments</p>
                            <a href="#" class="read-more-btn">Read More <i class="fas fa-chevron-double-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4">
                    <div class="latest-news-box">
                        <img src="{{asset('web/images/news-img3.png')}}" alt="img" class="img-fluid">
                        <div class="news-box-content">
                            <h4>LOREM IPSUM IS SIMPLY DUMMY TEXT OF THE PRINTING AND TYPESETTING</h4>
                            <p>April 22, 2022 No Comments</p>
                            <a href="#" class="read-more-btn">Read More <i class="fas fa-chevron-double-right"></i></a>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </section>
    --}}
</main>
@endsection