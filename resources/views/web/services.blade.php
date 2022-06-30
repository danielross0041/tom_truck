@extends('web.layouts.main')
@section('content')
<main>
    <section class="inner-banner-wrap inner-banner-bg">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="inner-banner-content">
                        <span class="new-span">Services</span>
                        <!-- <h2>Our Services</h2> -->
                        <?php echo (html_entity_decode(Helper::editck('h2', '', 'Our Services' ,'h2Our Services')));?>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="inner-banner-breadcrumb">
                        <ul>
                            <li><i class="fas fa-home"></i> <a href="#">Home</a></li>
                            <li><i class="fas fa-angle-right"></i> <span>Services</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>    
    </section>
    <section class="services-sec-wrap services-sec-wrap2">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="services-content">
                        <span class="new-span">Services</span>
                        <?php echo (html_entity_decode(Helper::editck('h2', '', 'Our Services' ,'h2Our Services')));?>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="services-content">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
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
                           <!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p> -->
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
</main>
@endsection