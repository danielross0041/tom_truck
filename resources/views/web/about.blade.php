@extends('web.layouts.main')
@section('content')
<main>
    <section class="inner-banner-wrap inner-banner-bg">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="inner-banner-content">
                        <span class="new-span">About</span>
                        <!-- <h2>About Us</h2> -->
                        <?php echo (html_entity_decode(Helper::editck('h2', '', 'About Us' ,'h2About Us')));?>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="inner-banner-breadcrumb">
                        <ul>
                            <li><i class="fas fa-home"></i> <a href="#">Home</a></li>
                            <li><i class="fas fa-angle-right"></i> <span>About</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="aboutus-sec-wrap aboutus-sec-wrap2">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="about-us-content">
                        <span class="new-span">About Us</span>
                        <!-- <h2>About Our Company</h2> -->
                        <?php echo (html_entity_decode(Helper::editck('h2', '', 'About Our Company' ,'h2About Our Company')));?>
                        <?php echo (html_entity_decode(Helper::editck('p', '', 'About Our CompanyLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown ' ,'pAbout OrCompnLomIpsu isimply dumtextotprintingandtypesettingindustr Lobeetheindustry’sstandardummtexeversint1500swhenaunknown')));?>
                        <!-- <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled
                            it to make a type specimen book.
                        </p> -->

                        <!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s</p> -->
                        <div class="about-founder-info">
                            <img src="{{asset($admin->profile_pic)}}" alt="thumb" class="img-fluid" />
                            <div class="founder-info-text">
                                <h6>{{$admin->name}}</h6>
                                <p>Founder</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="about-us-content">
                        <img src="{{asset('web/images/about-page-img1.jpg')}}" alt="img" class="img-fluid" />
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="about-us-content">
                        <img src="{{asset('web/images/about-page-img2.jpg')}}" alt="img" class="img-fluid" />
                        <?php echo (html_entity_decode(Helper::editck('p', '', 'Why Book With Us? Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the indust standard dummy text' ,'pWhy Book With Us? Lorem Ipsum is simplydummyt oftheprintingantypesetting dustryoremIsmha entetna um text')));?>
                        <!-- <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled
                            it to make a type specimen book.
                        </p>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s</p> -->
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
                                <!-- <p>Lorem Ipsum is simply dummy text of the printing</p> -->
                                <?php echo (html_entity_decode(Helper::editck('p', '', 'Lorem Ipsum is simply dummy text of the printing' ,'pDEDICATED CUSTOMER SUPPORTLorem Ipsum is simply dummy text of the printing')));?>
                            </div>
                            <div class="book-content-item">
                                <i class="fas fa-dollar-sign"></i>
                                <h6>LOWEST PRICE GUARANTEE</h6>
                                <!-- <p>Lorem Ipsum is simply dummy text of the printing</p> -->
                                <?php echo (html_entity_decode(Helper::editck('p', '', 'Lorem Ipsum is simply dummy text of the printing' ,'pLOWEST PRICE GUARANTEELorem Ipsum is simply dummy text of the printing')));?>
                            </div>
                            <div class="book-content-item">
                                <i class="far fa-check-double"></i>
                                <h6>FREE CANCELLATION</h6>
                                <!-- <p>Lorem Ipsum is simply dummy text of the printing</p> -->
                                <?php echo (html_entity_decode(Helper::editck('p', '', 'Lorem Ipsum is simply dummy text of the printing' ,'pFREE CANCELLATIONLorem Ipsum is simply dummy text of the printing')));?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection
