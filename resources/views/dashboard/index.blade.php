<!DOCTYPE html>
<html lang="en">
<head>
    @include('common.head')
</head>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                    <p class="site_title"><span>Chapplly Than</span></p>
                    </div>
                    <div class="clearfix"></div>
                    <br />
                    {{-- sidebar menu --}}
                    @include('common.sidebar_menu')
                    {{-- /sidebar menu --}}
                </div>
            </div>
            {{-- top navigation --}}
            @include('common.topnav')
            {{-- /top navigation --}}
            {{-- page content --}}
            @include('common.pagecontent')
            {{-- /page content --}}
        </div>
    </div>
    {{-- javascript file --}}
    @include('common.script')
    {{-- /javascript file --}}
</body>
</html>
