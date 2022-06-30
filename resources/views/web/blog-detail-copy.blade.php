@extends('web.layouts.main')
@section('content')
<main>
    <section class="inner-banner-wrap inner-banner-bg">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="inner-banner-content">
                        <span class="new-span">Blog</span>
                        <h2>{{$blog->title}}</h2>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="inner-banner-breadcrumb third-link">
                        <ul>
                            <li><i class="fas fa-home"></i> <a href="#">Home</a></li>
                            <li><i class="fas fa-angle-right"></i> <a href="#">Blog</a></li>
                            <li><i class="fas fa-angle-right"></i> <span>{{$blog->title}}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>    
    </section>
    <section class="blog-detail">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                    <img src="{{asset($blog->image)}}">

                    <h2>{{$blog->title}}</h2>
                    <ul>
                        <li><i class="fas fa-calendar-alt"></i>{{date("M d,Y" ,strtotime($blog->created_at))}}</li>
                    </ul>
                    {!!$blog->desc!!}
                </div>
            </div>
        </div>
    </section>
</main>
@endsection