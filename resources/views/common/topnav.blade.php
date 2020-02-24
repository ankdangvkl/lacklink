<div class="top_nav">
    <div class="nav_menu">
        {{-- <div class="nav toggle">
          <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div> --}}
        <nav class="nav navbar-nav">
        <ul class="navbar-right">
          <li class="nav-item dropdown open">
            <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
              ankdangvkl
            </a>
            <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item"  href="javascript:;"> Profile</a>
            <a href="{{ url('/create-user') }}" class="dropdown-item"  href="javascript:;">
                  {{-- <span class="badge bg-red pull-right">50%</span> --}}
                  <span>Create user</span>
                </a>
            {{-- <a class="dropdown-item"  href="javascript:;">Help</a> --}}
            <a class="dropdown-item"  href="{{ url('/logout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
            </div>
          </li>
          <li class="nav-item">
              <a href="javascript:;" class="user-profile" aria-haspopup="true" aria-expanded="false">
                Nạp tiền
              </a>
            </li>
          <li class="nav-item">
              <a href="javascript:;" class="user-profile" aria-haspopup="true" aria-expanded="false">
                Số dư: 0
              </a>
            </li>
          </ul>
      </nav>
    </div>
  </div>
