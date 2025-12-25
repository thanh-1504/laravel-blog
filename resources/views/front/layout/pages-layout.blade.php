<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('pageTitle')</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        accent: "#6d28d9",
                        textMain: "#111827",
                        textSub: "#6b7280",
                        border: "#e5e7eb",
                    },
                    fontFamily: {
                        sans: ["Inter", "sans-serif"],
                    },
                },
            },
        };
    </script>
</head>

<body class="bg-white font-sans text-textMain">

    <!-- HEADER -->
    <header class="border-b border-border">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <!-- LOGO -->
            <a href="{{ route('home') }}" class="text-xl font-bold text-accent hover:cursor-pointer">My Blog</a>

            <!-- NAV -->
            <nav class="flex items-center gap-8 text-sm text-textSub">
                {!! navigations() !!}
                <button onclick="toggleSearch()" class="hover:text-accent transition-colors p-1" aria-label="Search">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
                @auth
                    <div class="user-details relative cursor-pointer">
                        <div
                            class="w-8 h-8 rounded-full bg-accent flex items-center justify-center text-white overflow-hidden shadow-sm">
                            <img src="{{ auth()->user()->picture }}" alt="user avatar" class="w-full h-full object-cover">
                        </div>

                        <div
                            class="user-dropdown absolute right-0 mt-3 w-48 bg-white border border-border rounded-lg shadow-xl py-2 z-50 transition-all duration-200 opacity-0 invisible translate-y-2 [.active_&]:opacity-100 [.active_&]:visible [.active_&]:translate-y-0">
                            <a href="{{ route('profile') }}"
                                class="flex items-center gap-3 px-4 py-2 text-sm text-textMain hover:bg-gray-50 hover:text-accent transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Hồ sơ
                            </a>


                            @if (auth()->user()->type == 'superAdmin' || auth()->user()->type == 'admin')
                                <a href="{{ route('dashboard') }}"
                                    class="flex items-center gap-3 px-4 py-2 text-sm text-textMain hover:bg-gray-50 hover:text-accent transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                    </svg>
                                    Dashboard
                                </a>
                            @endif

                            <hr class="my-1 border-border">

                            <form id="front-logout-form" action="{{ route('logout', ['source' => 'front']) }}"
                                method="POST" style="display: none">
                                @csrf
                            </form>
                            <a href="javascript:;"
                                onclick="event.preventDefault();document.getElementById('front-logout-form').submit()"
                                class="flex items-center gap-3 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Đăng xuất
                            </a>
                        </div>
                    </div>
                @endauth

                {{-- Hiển thị nếu người dùng CHƯA đăng nhập (Khách) --}}
                @guest
                    <a href="{{ route('login') }}" class="text-sm font-medium hover:text-accent transition-colors">
                        Đăng nhập
                    </a>
                @endguest



            </nav>
        </div>
    </header>
    <div id="search-overlay"
        class="hidden border-b border-border bg-white sticky top-0 z-40 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 py-0 flex items-center justify-between">
            <form action="{{ route('search_posts') }}" method="GET" class="w-full mr-10">
                <input name="q" type="text" placeholder="Nhập tên bài viết để tìm ..."
                    class="w-full text-xl font-light text-textMain focus:outline-none placeholder:text-gray-300"
                    autoFocus value="{{ request('q') ? request('q') : '' }}" />
            </form>

            <button onclick="toggleSearch()" class="text-textSub hover:text-accent transition-colors p-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    @yield('content')

    <footer class="bg-gray-900 text-gray-300 mt-20">
        <div class="max-w-7xl mx-auto px-6 py-12">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div
                            class="w-10 h-10 bg-accent rounded-full flex items-center justify-center text-white font-bold text-lg">
                            D
                        </div>
                        <div class="text-white font-semibold text-lg leading-tight">
                           Laravel <br>
                            <span class="text-xs tracking-widest text-gray-400">BLOG</span>
                        </div>
                    </div>

                    <p class="text-gray-400 max-w-md leading-relaxed">
                        Nền tảng blog giúp kết nối mọi người
                    </p>
                </div>

                <div>
                    <h4 class="text-white text-lg font-semibold mb-4">
                        Liên hệ
                    </h4>

                    <ul class="space-y-3 text-gray-400">
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-2.26a1.125 1.125 0 00-.844-1.087l-3.712-.928a1.125 1.125 0 00-1.173.417l-.97 1.293a1.125 1.125 0 01-1.21.38A12.035 12.035 0 017.68 10.52a1.125 1.125 0 01.38-1.21l1.293-.97a1.125 1.125 0 00.417-1.173l-.928-3.712A1.125 1.125 0 007.76 2.25H5.5A2.25 2.25 0 003.25 4.5v2.25z" />
                            </svg>
                            0123 456 789
                        </li>

                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21.75 7.5v9a2.25 2.25 0 01-2.25 2.25H4.5A2.25 2.25 0 012.25 16.5v-9m19.5 0A2.25 2.25 0 0019.5 5.25H4.5A2.25 2.25 0 002.25 7.5m19.5 0l-9.75 6.75L2.25 7.5" />
                            </svg>
                            duongnhatthanh@gmail.com
                        </li>

                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                            Minh Phụng, Phường 9 Quận 6
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script>
        function toggleSearch() {
            const searchOverlay = document.getElementById('search-overlay');
            if (searchOverlay.classList.contains('hidden')) {
                searchOverlay.classList.remove('hidden');
                searchOverlay.querySelector('input').focus();
            } else {
                searchOverlay.classList.add('hidden');
            }
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === "Escape") {
                const searchOverlay = document.getElementById('search-overlay');
                if (!searchOverlay.classList.contains('hidden')) {
                    toggleSearch();
                }
            }
        });
    </script>
    <script>
        document.querySelector(".user-details").addEventListener("click", function(e) {
            this.classList.toggle("active");
        });
        document.addEventListener("click", function(e) {
            const userDetails = document.querySelector(".user-details");
            if (!userDetails.contains(e.target))
                userDetails.classList.remove("active");
        });
    </script>
</body>

</html>
