<div class="top_nav">
    <div class="nav_menu">
        <nav class="nav navbar-nav">
            <ul class="navbar-right">
                <li class="nav-item">
                    <a href="{{ url('/logout') }}" aria-haspopup="true" aria-expanded="false">
                        <span class="red" style="border: 1px solid #E74C3C;border-radius: 5px; padding: 5px;">Dang xuat</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/user-add-click') }}" aria-haspopup="true" aria-expanded="false">
                        <span class="green" style="border: 1px solid #1ABB9C;border-radius: 5px; padding: 5px;">Lien he nap tien</span>
                    </a>
                </li>
                <li class="nav-item"><span class="grey">{{ $userData['userName'] }}</span></li>
            </ul>
        </nav>
    </div>
</div>
