<!doctype html>
<html>
<head>
    @include('super_admin_inc.head')
</head>
<body class="pace-done sidebar-lg-show">
@include('super_admin_inc.header')
@include('super_admin_inc.sidebar_nav')
@yield('content')
@include('super_admin_inc.footer')
</body>
</html>