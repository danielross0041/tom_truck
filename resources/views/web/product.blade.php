@extends('web.layouts.main')
@section('content')

<main>
    <section class="inner-banner-wrap inner-banner-bg">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="inner-banner-content">
                        <span class="new-span">Product</span>
                        <!-- <h2>Products</h2> -->
                        <?php echo (html_entity_decode(Helper::editck('h2', '', 'Products' ,'h2Products')));?>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="inner-banner-breadcrumb">
                        <ul>
                            <li><i class="fas fa-home"></i> <a href="#">Home</a></li>
                            <li><i class="fas fa-angle-right"></i> <span>Product</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>    
    </section>
    <section class="product-sec-wrap">
        <div class="container">
            <div class="product-sec-head">
                <h2>Product List</h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
            </div>
            <div class="row">
                <div class="col-4 col-sm-4 col-md-4 col-lg-3 col-xl-3 col-xxl-3">
                    <div class="product-sidebar">
                        <div class="products-sidebar">
                            <h4>Categories</h4>
                            <div class="product-sidebar-list">
                                <ul>
                                    <li><a href="{{route('product')}}">All</a> </li>
                                    @foreach($categories as $category)
                                        <li><a href="{{route('categorized_product',$category->id)}}">{{$category->name}}</a> </li>
                                    @endforeach
                                </ul>
                            </div>
                            <h4>Categories Tag</h4>
                            <div class="product-tag-list">
                                <a href="#">M2 106</a>
                                <a href="#">122SD</a>
                                <a href="#">108SD</a>
                                <a href="#">ECASCADIA</a>
                                <a href="#">ECASCADIA</a>
                                <a href="#">CASCADIA</a>
                            </div>
                            <h4>Filter By</h4>
                            <div class="filter-range">
                                <div class="range-slider">     
                                    <p class="range-slider__value">5000 $</p>
                                    <div class="range-slider__slider">
                                        <input type="range" min="10000" max="200000" value="200000" class="slider" id="rangeSlider"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-8 col-sm-8 col-md-8 col-lg-9 col-xl-9 col-xxl-9">
                    <div class="product-listing" id="products-list">
                        <div class="row">
                            @if(!$products->isEmpty())
                            @foreach($products as $product)
                            <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4">
                                <div class="product-listing-item">
                                    <img src="{{asset($product->image)}}" alt="img" class="img-fluid">
                                    <div class="product-item-content">
                                        <a href="{{route('product_list',$product->id)}}"><h4>{{$product->name}} | {{$product->category->name}}</h4></a>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
                                    </div>
                                    <button class="contact-now-btn" id="customer_contact" data-product_id="{{$product->id}}" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Contact Now</button>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <h4>No Product Found</h4>
                            @endif
                            
                            {!! $products->render('pagination::bootstrap-4') !!}
                            <!-- <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                <div class="pagination-list">
                                    <ul>
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li><a href="#">5</a></li>
                                        <li><a href="#">6</a></li>
                                        <li><a href="#">7</a></li>
                                    </ul>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection