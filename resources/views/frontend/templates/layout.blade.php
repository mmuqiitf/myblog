<!DOCTYPE html>
<html lang="en">
@include('frontend.templates.head')

<body>
    @include('frontend.templates.nav')
    <div class="container mb-4">
        <header>
            <a href="index.html"><img src="{{ asset('app/images/mylogo.png') }}"></a>
        </header>
        @yield('slider')
        <section>
            <div class="row">
                @yield('content')
                @yield('sidebar')
            </div>
        </section>
    </div><!-- /.container -->

    @include('frontend.templates.footer')
</body>

</html>
