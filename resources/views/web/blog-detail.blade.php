@extends('web.layouts.main')
@section('content')
<main>
    <section class="inner-banner-wrap inner-banner-bg">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="inner-banner-content">
                        <span class="new-span">Blogs</span>
                        <h2>{{$blog->title}}</h2>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="inner-banner-breadcrumb">
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
    <section class="blog-detail-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                    <div class="blog-detail-data">
                        <img src="{{asset($blog->image)}}" alt="img" class="img-fluid">
                        <div class="blog-detail-content">
                            <h4>{{$blog->title}}</h4>
                            <ul>
                                <li><p><i class="fas fa-calendar-alt"></i>{{date("M d,Y" ,strtotime($blog->created_at))}}</p></li>
                                <li><p><i class="fas fa-user"></i> By : {{$blog->author->name}}</p></li>
                                <li><p><i class="fas fa-file-edit"></i> Blog</p></li>
                                <li><p><i class="fas fa-comments"></i> 8</p></li>
                            </ul>
                            {!!$blog->desc!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
