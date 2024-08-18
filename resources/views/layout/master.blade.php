<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        @yield('title')
    </title>

    @include('layout.header')
</head>
<body>
    <div class="container">
        @include('layout.tabitem')

        @include('alert')

        @yield('content')

        @include('layout.footer')

        @yield('extra-script')
    </div>

</body>
</html>
