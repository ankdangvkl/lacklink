<div class="top_nav">
    <div class="nav_menu">
        {{-- <div class="nav toggle">
          <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div> --}}
        <nav class="nav navbar-nav">
        <ul class="navbar-right">
          <li class="nav-item dropdown open">
            <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
              {{ $data['username'] }}
            </a>
            <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item"  href="#Detail">Chi tiết</a>
            <a class="dropdown-item"  href="{{ url('/logout') }}"><i class="fa fa-sign-out pull-right"></i>Đăng xuất</a>
            </div>
          </li>
          <li class="nav-item">
            <a href="{{ url('/user/package') }}" @if($data['payAmount'] <= 0 || $data['clicks'] == 0) style="color:red;" @else style="color:#5E6974;" @endif  aria-haspopup="true" aria-expanded="false">Nạp tiền</a>
          </li>
          {{-- <li class="nav-item">
              <a href="javascript:;" class="user-profile" aria-haspopup="true" aria-expanded="false">Số dư: {{ $data['payAmount'] }}</a>
            </li> --}}
          </ul>
      </nav>
    </div>
  </div>
