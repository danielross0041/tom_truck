<?php
$logo = App\Models\logo::where('is_active',1)->orderBy('id','desc')->first();
?>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{route('index')}}">
            <img src="{{asset($logo->image)}}" alt="logo" class="img-fluid" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item {{Route::current()->getName()=='index'?'active':''}}">
                    <a class="nav-link" aria-current="page" href="{{route('index')}}">Home</a>
                </li>
                <li class="nav-item {{Route::current()->getName()=='about'?'active':''}}">
                    <a class="nav-link" href="{{route('about')}}">About</a>
                </li>
                {{--
                <li class="nav-item {{Route::current()->getName()=='services'?'active':''}}">
                    <a class="nav-link" href="{{route('services')}}">Services</a>
                </li>
                <li class="nav-item {{Route::current()->getName()=='blog'?'active':''}}">
                    <a class="nav-link" href="{{route('blog')}}">Blog</a>
                </li>
                --}}
                <li class="nav-item {{Route::current()->getName()=='product'?'active':''}}">
                    <a class="nav-link" href="{{route('product')}}">Product</a>
                </li>
                <li class="nav-item {{Route::current()->getName()=='sellers'?'active':''}}">
                    <a class="nav-link" href="{{route('sellers')}}">Sellers</a>
                </li>
                @auth
                    <li class="nav-item ">
                        <a class="nav-link" href="{{route('user_profile')}}">Admin Panel</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>           
                @endauth
                @guest
                    <li class="nav-item {{Route::current()->getName()=='login'?'active':''}}">
                        <a class="nav-link" href="{{route('login')}}">Login</a>
                    </li>
                    <!-- <li class="nav-item {{Route::current()->getName()=='register_vendor'?'active':''}}">
                        <a class="nav-link" href="{{route('register_vendor')}}">Register</a>
                    </li> -->
                @endguest
            </ul>
            @guest
            <div class="contact-us-button">
                <a href="{{route('register_vendor')}}" class="contact-btn">Register</a>
            </div>
            @endguest
            <div class="contact-us-button">
                <a href="{{route('contact')}}" class="contact-btn">Contact Us</a>
            </div>
        </div>
    </div>
</nav>
