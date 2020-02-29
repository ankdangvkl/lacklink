<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
        <p class="site_title"><span>Chapall</span></p>
        </div>
        <div class="clearfix"></div>
        <br />
        {{-- sidebar menu --}}
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <ul class="nav side-menu">
                <li><a href="{{ url('/') }}"><i class="fa fa-home"></i>Tổng quan</a>
                </li>
                <li><a href="{{ url('/access') }}"><i class="fa fa-edit"></i>Truy cập</a>
                </li>
                <li><a href="{{ url('/campaign') }}"><i class="fa fa-desktop"></i>Chiến dịch</a>
                </li>
                <li><a href="{{ url('/domain') }}"><i class="fa fa-table"></i>Tên miền</a>
                </li>
                <li><a href="{{ url('/package') }}"><i class="fa fa-bar-chart-o"></i>Mua gói</a>
                </li>
                <li><a href="{{ url('/instruction') }}"><i class="fa fa-clone"></i>Hướng dẫn</a>
                </li>
              </ul>
            </div>
        </div>
        {{-- /sidebar menu --}}
    </div>
</div>
