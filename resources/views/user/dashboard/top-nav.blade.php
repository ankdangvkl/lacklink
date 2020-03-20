<div class="top_nav">
    <div class="nav_menu">
        {{-- <div class="nav toggle">
          <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div> --}}
        <nav class="nav navbar-nav">
        <ul class="navbar-right">
          <li class="nav-item dropdown open">
            <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
              {{ $data['name'] }}
            </a>
            <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item"  href="#Detail">Chi tiết</a>
            <a class="dropdown-item"  href="{{ url('/logout') }}"><i class="fa fa-sign-out pull-right"></i>Đăng xuất</a>
            </div>
          </li>

          <li class="nav-item">
            @if($data['payAmount'] <= 0 || $data['clicks'] == 0)
                <a href="{{ url('/payment') }}" aria-haspopup="true" aria-expanded="false">
                    <span class="red" style="border: 1px solid #E74C3C;border-radius: 5px; padding: 5px;">Nạp tiền</span>
                </a>
            @else
                <span style="cursor: pointer;">Nạp tiền</span>
            @endif

          </li>
          {{-- <li class="nav-item">
              <a href="javascript:;" class="user-profile" aria-haspopup="true" aria-expanded="false">Số dư: {{ $data['payAmount'] }}</a>
            </li> --}}
          </ul>
      </nav>
    </div>
  </div>
