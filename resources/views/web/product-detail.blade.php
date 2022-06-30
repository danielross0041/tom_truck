@extends('web.layouts.main') @section('content')

<main>
    <section class="inner-banner-wrap inner-banner-bg">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="inner-banner-content">
                        <span class="new-span">Product Detail</span>
                        <!-- <h2>Products Detail</h2> -->
                        <?php echo (html_entity_decode(Helper::editck('h2', '', 'Products Detail' ,'h2Products Detail')));?>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="inner-banner-breadcrumb">
                        <ul>
                            <li><i class="fas fa-home"></i> <a href="#">Home</a></li>
                            <li><i class="fas fa-angle-right"></i> <span>Product Detail</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="product-sec-wrap product-detail-wrap">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-sm-12 col-md-12 col-lg-7 col-xl-7 col-xxl-7">
                    <div class="poduct-detail-img">
                        <div class="carousel carousel-main" data-flickity='{"pageDots": false }'>
                            @foreach($product_images as $product_image)
                            <div class="carousel-cell imglist">
                                <a href="{{asset($product_image->image)}}" data-fancybox="group">
                                    <img src="{{asset($product_image->image)}}" />
                                    <div class="play-icon">
                                        <i class="fas fa-search-plus"></i>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>

                        <div class="carousel carousel-nav" data-flickity='{ "asNavFor": ".carousel-main", "contain": true, "pageDots": false }'>
                            @foreach($product_images as $product_image)
                            <div class="carousel-cell"><img src="{{asset($product_image->image)}}" /></div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-5 col-xl-5 col-xxl-5">
                    <div class="product-detail-content">
                        <h4>{{$product->name}}</h4>
                        <p>Year : <span>{{$product->year}}</span></p>
                        <p>Manufacturer : <span>{{$product->manufacturer}}</span></p>
                        <p>Model : <span>{{$product->model}}</span></p>
                        <p>VIN : <span>{{$product->vin}}</span></p>
                        <p>GVWR : <span>{{$product->gvwr}}</span></p>
                        <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nos trud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. duis aute irure dolor in reprehenderit.</span></p> -->
                        <strong>Please call/text or email - thanks!</strong>
                        <ul>
                            <li>
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo(url()->current()) ?>"><i class="fab fa-facebook-f"></i> Facebook</a>
                            </li>
                            <li>
                                <a href="#"><i class="fab fa-instagram"></i> Instagram</a>
                            </li>
                            <li>
                                <a href="https://twitter.com/intent/tweet?url=<?php echo(url()->current()) ?>&text="><i class="fab fa-twitter"></i> Twitter</a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo(url()->current()) ?>"><i class="fab fa-linkedin-in"></i> Linked In</a>
                            </li>
                            <li>
                                <a href="#"><i class="fab fa-youtube"></i> Youtube</a>
                            </li>
                        </ul>
                        <button class="contact-now-btn" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" id="customer_contact" data-product_id="{{$product->id}}">Contact Now</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="product-detail-info">
        <div class="container">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                <div class="products-info-tabs">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-description-tab" data-bs-toggle="pill" data-bs-target="#pills-description" type="button" role="tab" aria-controls="pills-description" aria-selected="true">
                                Description
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-review-tab" data-bs-toggle="pill" data-bs-target="#pills-review" type="button" role="tab" aria-controls="pills-review" aria-selected="false">Review</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
                            <div class="product-description">
                                <h2>Product Description</h2>
                                <?php echo(html_entity_decode($product->desc)); ?>
                            </div>
                            <div class="specification-head">
                                <h3>Interior Information</h3>
                                <div class="row">
                                    <div class="col-4 col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <h4>Driver Seat</h4>
                                    </div>
                                    <div class="col-8 col-md-8 col-sm-8 col-lg-8 col-xl-8 col-xxl-8">
                                        <h5>{{$product->driver_seat}}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <h4>Passenger Seat</h4>
                                    </div>
                                    <div class="col-8 col-md-8 col-sm-8 col-lg-8 col-xl-8 col-xxl-8">
                                        <h5>{{$product->pessenger_seat}}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <h4>Radio</h4>
                                    </div>
                                    <div class="col-8 col-md-8 col-sm-8 col-lg-8 col-xl-8 col-xxl-8">
                                        <h5>{{$product->radio}}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <h4>Sleeper Length</h4>
                                    </div>
                                    <div class="col-3 col-md-3 col-sm-3 col-lg-3 col-xl-3 col-xxl-3">
                                        <h5>{{$product->sleeper_size}}</h5>
                                    </div>
                                    <div class="col-3 col-md-3 col-sm-3 col-lg-3 col-xl-3 col-xxl-3">
                                        <h6>Sleeper Type</h6>
                                    </div>
                                    <div class="col-2 col-md-2 col-sm-2 col-lg-2 col-xl-2 col-xxl-2">
                                        <h5>{{$product->sleeper}}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <h4>Air Condition</h4>
                                    </div>
                                    <div class="col-8 col-md-8 col-sm-8 col-lg-8 col-xl-8 col-xxl-8">
                                        <h5>{{$product->air_condition}}</h5>
                                    </div>
                                </div>
                                
                                
                            </div>
                            <div class="specification-head">
                                <h3>Machenical Information</h3>
                                <div class="row">
                                    <div class="col-4 col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <h4>Mileage</h4>
                                    </div>
                                    <div class="col-3 col-md-3 col-sm-3 col-lg-3 col-xl-3 col-xxl-3">
                                        <h5>{{$product->mileage}}</h5>
                                    </div>
                                    <div class="col-3 col-md-3 col-sm-3 col-lg-3 col-xl-3 col-xxl-3">
                                        <h6>Hours</h6>
                                    </div>
                                    <div class="col-2 col-md-2 col-sm-2 col-lg-2 col-xl-2 col-xxl-2">
                                        <h5>{{$product->hours}}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <h4>Engine Make</h4>
                                    </div>
                                    <div class="col-8 col-md-8 col-sm-8 col-lg-8 col-xl-8 col-xxl-8">
                                        <h5>{{$product->engine_manufacturer}}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <h4>Engine Model</h4>
                                    </div>
                                    <div class="col-8 col-md-8 col-sm-8 col-lg-8 col-xl-8 col-xxl-8">
                                        <h5>{{$product->engine_model}}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <h4>Engine Horse Power</h4>
                                    </div>
                                    <div class="col-8 col-md-8 col-sm-8 col-lg-8 col-xl-8 col-xxl-8">
                                        <h5>{{$product->horsepower}}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <h4>Transmission</h4>
                                    </div>
                                    <div class="col-8 col-md-8 col-sm-8 col-lg-8 col-xl-8 col-xxl-8">
                                        <h5>{{$product->transmission}}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                                        <h4>Axle Rating (GVWR)</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <h4>Front Axle</h4>
                                    </div>
                                    <div class="col-8 col-md-8 col-sm-8 col-lg-8 col-xl-8 col-xxl-8">
                                        <h5>{{$product->front_axle}}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <h4>Driver Axle(s)</h4>
                                    </div>
                                    <div class="col-3 col-md-3 col-sm-3 col-lg-3 col-xl-3 col-xxl-3">
                                        <h5>{{$product->driver_axle}}</h5>
                                    </div>
                                    <div class="col-3 col-md-3 col-sm-3 col-lg-3 col-xl-3 col-xxl-3">
                                        <h6>Ratio</h6>
                                    </div>
                                    <div class="col-2 col-md-2 col-sm-2 col-lg-2 col-xl-2 col-xxl-2">
                                        <h5>{{$product->ratio}}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <h4>Tag, Pusher, Cheater axle</h4>
                                    </div>
                                    <div class="col-8 col-md-8 col-sm-8 col-lg-8 col-xl-8 col-xxl-8">
                                        <h5>{{$product->tag_axle}}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <h4>Power Steering</h4>
                                    </div>
                                    <div class="col-8 col-md-8 col-sm-8 col-lg-8 col-xl-8 col-xxl-8">
                                        <h5>{{$product->power_steering}}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <h4>Jake Brake</h4>
                                    </div>
                                    <div class="col-8 col-md-8 col-sm-8 col-lg-8 col-xl-8 col-xxl-8">
                                        <h5>{{$product->jake_brake}}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <h4>5th Wheel</h4>
                                    </div>
                                    <div class="col-8 col-md-8 col-sm-8 col-lg-8 col-xl-8 col-xxl-8">
                                        <h5>{{$product->th_wheel}}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="specification-head">
                                <h3>Exterior Information</h3>
                                <div class="row">
                                    <div class="col-4 col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <h4>Wheel Base(inches)</h4>
                                    </div>
                                    <div class="col-8 col-md-8 col-sm-8 col-lg-8 col-xl-8 col-xxl-8">
                                        <h5>{{$product->wheel_base}}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                    </div>
                                    <div class="col-2 col-md-2 col-sm-2 col-lg-2 col-xl-2 col-xxl-2">
                                        <h6>CA or CT</h6>
                                    </div>
                                    <div class="col-2 col-md-2 col-sm-2 col-lg-2 col-xl-2 col-xxl-2">
                                        <h5>{{$product->ca_ct}}</h5>
                                    </div>
                                    <div class="col-2 col-md-2 col-sm-2 col-lg-2 col-xl-2 col-xxl-2">
                                        <h6>CAb to end of Frame</h6>
                                    </div>
                                    <div class="col-2 col-md-2 col-sm-2 col-lg-2 col-xl-2 col-xxl-2">
                                        <h5>{{$product->end_of_frame}}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <h4>Wheels</h4>
                                    </div>
                                    <div class="col-8 col-md-8 col-sm-8 col-lg-8 col-xl-8 col-xxl-8">
                                        <h5>{{$product->wheels}}</h5>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-4 col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <h4>Tires</h4>
                                    </div>
                                    <div class="col-8 col-md-8 col-sm-8 col-lg-8 col-xl-8 col-xxl-8">
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                    </div>
                                    <div class="col-2 col-md-2 col-sm-2 col-lg-2 col-xl-2 col-xxl-2">
                                        <h6>Front Tire Size</h6>
                                    </div>
                                    <div class="col-2 col-md-2 col-sm-2 col-lg-2 col-xl-2 col-xxl-2">
                                        <h5>{{$product->front_tire_size}}</h5>
                                    </div>
                                    <div class="col-2 col-md-2 col-sm-2 col-lg-2 col-xl-2 col-xxl-2">
                                        <h6>Rare Tire Size</h6>
                                    </div>
                                    <div class="col-2 col-md-2 col-sm-2 col-lg-2 col-xl-2 col-xxl-2">
                                        <h5>{{$product->rare_tire_size}}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <h4>Fuel Tanks</h4>
                                    </div>
                                    <div class="col-8 col-md-8 col-sm-8 col-lg-8 col-xl-8 col-xxl-8">
                                        <h5>{{$product->rare_tire_size}}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                    </div>
                                    <div class="col-2 col-md-2 col-sm-2 col-lg-2 col-xl-2 col-xxl-2">
                                        <h6># of Tanks</h6>
                                    </div>
                                    <div class="col-2 col-md-2 col-sm-2 col-lg-2 col-xl-2 col-xxl-2">
                                        <h5>{{$product->no_of_tanks}}</h5>
                                    </div>
                                    <div class="col-2 col-md-2 col-sm-2 col-lg-2 col-xl-2 col-xxl-2">
                                        <h6>Gallons</h6>
                                    </div>
                                    <div class="col-2 col-md-2 col-sm-2 col-lg-2 col-xl-2 col-xxl-2">
                                        <h5>{{$product->gallons}}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                    </div>
                                    <div class="col-2 col-md-2 col-sm-2 col-lg-2 col-xl-2 col-xxl-2">
                                        <h6>Steer R</h6>
                                    </div>
                                    <div class="col-2 col-md-2 col-sm-2 col-lg-2 col-xl-2 col-xxl-2">
                                        <h5>{{$product->steer_r}}</h5>
                                    </div>
                                    <div class="col-2 col-md-2 col-sm-2 col-lg-2 col-xl-2 col-xxl-2">
                                        <h6>L</h6>
                                    </div>
                                    <div class="col-2 col-md-2 col-sm-2 col-lg-2 col-xl-2 col-xxl-2">
                                        <h5>{{$product->steer_l}}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                    </div>
                                    <div class="col-2 col-md-2 col-sm-2 col-lg-2 col-xl-2 col-xxl-2">
                                        <h6>Drive FR</h6>
                                    </div>
                                    <div class="col-2 col-md-2 col-sm-2 col-lg-2 col-xl-2 col-xxl-2">
                                        <h5>{{$product->drive_fr}}</h5>
                                    </div>
                                    <div class="col-2 col-md-2 col-sm-2 col-lg-2 col-xl-2 col-xxl-2">
                                        <h6>FL</h6>
                                    </div>
                                    <div class="col-2 col-md-2 col-sm-2 col-lg-2 col-xl-2 col-xxl-2">
                                        <h5>{{$product->drive_fl}}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                    </div>
                                    <div class="col-2 col-md-2 col-sm-2 col-lg-2 col-xl-2 col-xxl-2">
                                        <h6>Drive RR</h6>
                                    </div>
                                    <div class="col-2 col-md-2 col-sm-2 col-lg-2 col-xl-2 col-xxl-2">
                                        <h5>{{$product->drive_rr}}</h5>
                                    </div>
                                    <div class="col-2 col-md-2 col-sm-2 col-lg-2 col-xl-2 col-xxl-2">
                                        <h6>RL</h6>
                                    </div>
                                    <div class="col-2 col-md-2 col-sm-2 col-lg-2 col-xl-2 col-xxl-2">
                                        <h5>{{$product->drive_rl}}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <h4>Suspension</h4>
                                    </div>
                                    <div class="col-3 col-md-3 col-sm-3 col-lg-3 col-xl-3 col-xxl-3">
                                        <h5>{{$product->suspension}}</h5>
                                    </div>
                                    <div class="col-3 col-md-3 col-sm-3 col-lg-3 col-xl-3 col-xxl-3">
                                        <h6>Suspension Type</h6>
                                    </div>
                                    <div class="col-2 col-md-2 col-sm-2 col-lg-2 col-xl-2 col-xxl-2">
                                        <h5>{{$product->suspension_type}}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <h4>Brakes</h4>
                                    </div>
                                    <div class="col-8 col-md-8 col-sm-8 col-lg-8 col-xl-8 col-xxl-8">
                                        <h5>{{$product->brakes}}</h5>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="specification-head">
                                <h3>Accessories</h3>
                                <div class="row">
                                    @php
                                    $acces = unserialize($product->accessories);
                                    @endphp
                                    @foreach($acces as $val)
                                    <div class="col-2 col-md-2 col-sm-2 col-lg-2 col-xl-2 col-xxl-2">
                                        <h5>{{ucwords(str_replace('_', ' ',$val))}}</h5>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col-4 col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <h4>Mirrors</h4>
                                    </div>
                                    <div class="col-3 col-md-3 col-sm-3 col-lg-3 col-xl-3 col-xxl-3">
                                        <h5>{{$product->mirror}}</h5>
                                    </div>
                                    <div class="col-3 col-md-3 col-sm-3 col-lg-3 col-xl-3 col-xxl-3">
                                        <h6>Side</h6>
                                    </div>
                                    <div class="col-2 col-md-2 col-sm-2 col-lg-2 col-xl-2 col-xxl-2">
                                        <h5>{{$product->mirror_side}}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <h4>Windows</h4>
                                    </div>
                                    <div class="col-3 col-md-3 col-sm-3 col-lg-3 col-xl-3 col-xxl-3">
                                        <h5>{{$product->window}}</h5>
                                    </div>
                                    <div class="col-3 col-md-3 col-sm-3 col-lg-3 col-xl-3 col-xxl-3">
                                        <h6>Side</h6>
                                    </div>
                                    <div class="col-2 col-md-2 col-sm-2 col-lg-2 col-xl-2 col-xxl-2">
                                        <h5>{{$product->window_side}}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <h4>Wet Kit</h4>
                                    </div>
                                    <div class="col-8 col-md-8 col-sm-8 col-lg-8 col-xl-8 col-xxl-8">
                                        <h5>{{$product->wet_kit}}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="specification-head">
                                <h3>Body</h3>
                                <div class="row">
                                    <div class="col-4 col-md-4 col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <h4>Type</h4>
                                    </div>
                                    <div class="col-8 col-md-8 col-sm-8 col-lg-8 col-xl-8 col-xxl-8">
                                        <h5>{{$product->body}}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3 col-md-3 col-sm-3 col-lg-3 col-xl-3 col-xxl-3">
                                        <h6>Length</h6>
                                    </div>
                                    <div class="col-3 col-md-3 col-sm-3 col-lg-3 col-xl-3 col-xxl-3">
                                        <h5>{{$product->body_lenght}}</h5>
                                    </div>
                                    <div class="col-3 col-md-3 col-sm-3 col-lg-3 col-xl-3 col-xxl-3">
                                        <h6>Width</h6>
                                    </div>
                                    <div class="col-3 col-md-3 col-sm-3 col-lg-3 col-xl-3 col-xxl-3">
                                        <h5>{{$product->body_width}}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3 col-md-3 col-sm-3 col-lg-3 col-xl-3 col-xxl-3">
                                        <h6>Height</h6>
                                    </div>
                                    <div class="col-3 col-md-3 col-sm-3 col-lg-3 col-xl-3 col-xxl-3">
                                        <h5>{{$product->body_height}}</h5>
                                    </div>
                                    <div class="col-3 col-md-3 col-sm-3 col-lg-3 col-xl-3 col-xxl-3">
                                        <h6>Gallons</h6>
                                    </div>
                                    <div class="col-3 col-md-3 col-sm-3 col-lg-3 col-xl-3 col-xxl-3">
                                        <h5>{{$product->body_gallons}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-review" role="tabpanel" aria-labelledby="pills-review-tab">
                            <div class="product-reviews">
                                <h2>3 Reviews</h2>
                                @foreach($reviews as $review)
                                <div class="product-review-item">
                                    <div class="product-review-thumb">
                                        <img src="{{asset('web/images/dummy_profile.png')}}" alt="thumb" class="img-fluid" />
                                    </div>
                                    <div class="product-review-info">
                                        <h4>{{$review->name}}</h4>
                                        <span>{{date("M d,Y" ,strtotime($review->created_at))}}</span>
                                        <p>
                                            {{$review->review}}
                                        </p>
                                    </div>
                                </div>
                                @endforeach
                                <div class="product-review-form">
                                    <h2>Add Review</h2>
                                    <p><span>Your email address will not be published.</span> Required fields are marked*</p>
                                    <form method="POST" action="{{route('review_submit')}}">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" name="name" required />
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" name="email" required />
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Phone</label>
                                                    <input type="phone" name="phone" required />
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                <div class="form-group">
                                                    <label>Add Review</label>
                                                    <textarea name="review" required></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                                <div class="form-group">
                                                    <button class="submit-btn-review">Submit Review</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
