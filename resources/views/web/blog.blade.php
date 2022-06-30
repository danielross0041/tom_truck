@extends('web.layouts.main')
@section('content')
<main>
    <section class="inner-banner-wrap inner-banner-bg">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="inner-banner-content">
                        <span class="new-span">Blog</span>
                        <!-- <h2>Our Blogs</h2> -->
                        <?php echo (html_entity_decode(Helper::editck('h2', '', 'Our Blogs' ,'h2Our Blogs')));?>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="inner-banner-breadcrumb">
                        <ul>
                            <li><i class="fas fa-home"></i> <a href="#">Home</a></li>
                            <li><i class="fas fa-angle-right"></i> <span>Blog</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>    
    </section>

    <section class="latest-news-sec">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4">
                    <div class="latest-news-head">
                        <div class="latest-news-info">
                            <span>Updates</span>
                            <h4>Latest News</h4>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="latest-news-head">
                        <div class="latest-news-info">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
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
            </div>
        </div>
    </section>
</main>
@endsection