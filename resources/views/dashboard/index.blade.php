<!DOCTYPE html>
<html lang="en">
<head>
    @include('common.head')
</head>
<body class="nav-md">
    <div class="container body">
        @yield('admin')
        @yield('user')
        @yield('user-access')
        @yield('user-campaign')
        @yield('user-domain')
        @yield('user-instruction')
        @yield('user-package')
    </div>
    {{-- javascript file --}}
    @include('common.script')
    {{-- /javascript file --}}
</body>
</html>
