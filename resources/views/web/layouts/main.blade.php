<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="keywords" content="HTML, CSS, JavaScript" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        @include('web.layouts.links')
        <title>{{isset($title)?$title:'Truck'}}</title>
    </head>
    <body>
        <!-- Header Start -->
        <header class="header-main-wrap">
            @include('web.layouts.header')
        </header>
        

        @yield('content')


        <footer class="footer-main-wrap">
            @include('web.layouts.footer')
        </footer>
        
        @include('web.layouts.contact_modal')

        @include('web.layouts.scripts')
        @yield('js')
    </body>
</html>

