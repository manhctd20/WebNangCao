<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Bắt sự kiện click vào tên người dùng
        $(".user-menu-trigger").click(function(e) {
            e.preventDefault();
            // Hiển thị hoặc ẩn menu dropdown
            $(".user-menu").toggle();
        });
    });
</script>
<style>
    /* Dropdown container */
    .user-menu {
        display: none;
        position: absolute;
        top: 100%;
        right: 0;
        background-color: #fff;
        border: 1px solid #ccc;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        min-width: 180px;
        z-index: 100;
        border-radius: 5px;
    }

    /* Dropdown list items */
    .user-menu a {
        display: block;
        padding: 10px 15px;
        text-decoration: none;
        color: #333;
        transition: background-color 0.3s;
        font-size: 16px;
    }

    .user-menu a:hover {
        background-color: #f0f0f0;
        color: #000;
    }
</style>

<header class="header" id="header">
    <nav class="nav container">
        <a href="{{ route('home') }}" class="nav__logo"><img width="200" style="height: 70px; object-fit: cover"
                src="{{ asset('frontend/assets/images/logo.jpg') }}" alt="" /></a>

        <div class="nav__menu" id="nav-menu">
            <ul class="nav__list align-items-center">
                <li class="nav__item">
                    <a href="{{ route('home') }}" class="nav__link {{ request()->is('/') ? ' active-link' : '' }}"">
                        <i class="bx bx-home-alt nav__icon"></i>
                        <span class="nav__name">Trang Chủ</span>
                    </a>
                </li>

                <li class="nav__item">
                    <a href="{{ route('posts') }}" class="nav__link {{ request()->is('posts') ? ' active-link' : '' }}">
                        <i class="bx bx-book-alt nav__icon"></i>
                        <span class="nav__name">Tin Tức</span>
                    </a>
                </li>

                <li class="nav__item">
                    <a href="{{ route('package') }}"
                        class="nav__link {{ request()->is('paket-travel') ? ' active-link' : '' }}">
                        <i class="bx bx-briefcase-alt nav__icon"></i>
                        <span class="nav__name">Tour Du Lịch</span>
                    </a>
                </li>

                <li class="nav__item">
                    <a href="{{ route('contact') }}"
                        class="nav__link {{ request()->is('contact') ? ' active-link' : '' }}">
                        <i class="bx bx-message-square-detail nav__icon"></i>
                        <span class="nav__name">Liên Hệ</span>
                    </a>
                </li>

                @if (isset(Auth::user()->id))
                    <li class="nav__item">
                        <div class="dropdown">
                            <a class="user-menu-trigger">
                                <img width="35" class="img-profile rounded-circle"
                                    src="{{ asset('backend/img/undraw_profile.svg') }}">
                                {{ Auth::user()->name }}
                            </a>
                            @auth
                                <div class="user-menu">
                                    <a href="{{ route('users.edit', [auth()->id()]) }}">Thay đổi thông tin</a>
                                    @if (Auth::user()->isAdmin())
                                        <a href="{{ route('admin.dashboard') }}">Trang quản lý</a>
                                    @endif
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            @endauth
                        </div>
                    </li>
                @else
                    <li class="nav__item">
                        <a href="{{ route('login') }}" id="loginLink" class="user"
                            style="font-size: 1rem;color: #42414e; font-weight: 600">
                            <span class="nav__name">Đăng Nhập</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
</header>
