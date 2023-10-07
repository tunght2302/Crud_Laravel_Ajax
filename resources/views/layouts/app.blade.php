@include('layouts.header')

<body>
    <div class="container mt-5">
        @yield('title')
        @yield('content')
    </div>
    @include('layouts.cdnscript')
    @yield('ajax')
</body>

</html>
