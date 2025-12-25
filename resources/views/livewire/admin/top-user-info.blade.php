<div>
    <div class="user-info-dropdown">
        <div class="dropdown">
            <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                <span class="user-icon">
                    <img style="width: 100%;height: 100%;" src="{{ $user->picture }}" alt="" />
                </span>
                <span class="user-name">{{ $user->name }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                <a class="dropdown-item" href="{{ route('home') }}"><i class="dw dw-home"></i>
                    Trang chủ</a>
                <a class="dropdown-item" href="{{ route('profile') }}"><i class="dw dw-user1"></i>
                    Hồ sơ</a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit()"><i
                        class="dw dw-logout"></i> Đăng xuất</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
