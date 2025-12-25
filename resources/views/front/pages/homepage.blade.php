@extends('front.layout.pages-layout')
@section('pageTitle', 'Trang chủ')
@section('content')
    <main class="max-w-7xl mx-auto px-6 py-10 space-y-16">

        <!-- ================= FEATURED POST (THEO ẢNH) ================= -->
        <section class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            <!-- Featured Post -->
            @if (!empty(latest_posts(0, 1)))
                @foreach (latest_posts(0, 1) as $post)
                    <div class="lg:col-span-2">
                        <div class="relative">
                            <img src="" class="rounded-lg w-full h-[380px] object-cover" />
                            <span class="absolute bottom-4 left-4 bg-black/60 text-white text-sm px-3 py-1 rounded">
                                {{ $post->post_category->name }}
                            </span>
                        </div>

                        <a href="{{ route('read_post', $post->slug) }}"
                            class="text-2xl font-bold mt-6 inline-block hover:text-accent transition-colors">
                            {{ $post->title }}
                        </a>

                        <ul class="flex flex-wrap items-center gap-x-4 gap-y-2 text-sm text-textSub mt-3">
                            <li class="flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <a href="{{ route('author_posts', $post->author->username) }}"
                                    class="hover:text-accent">{{ $post->author->name }}</a>
                            </li>

                            <li class="flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                {{ date_formatter($post->created_at) }}
                            </li>

                            <li class="flex items-center gap-1">
                                <span class="text-textMain font-medium">Danh mục :</span>
                                <a href="{{ route('category_posts', $post->post_category->slug) }}"
                                    class="text-accent hover:underline ml-1">
                                    {{ $post->post_category->name }}
                                </a>
                            </li>
                            <li class="flex items-center gap-1">
                                <span class="text-textMain font-medium">Tags :</span>
                                <a href="{{ route('category_posts', $post->post_category->slug) }}"
                                    class="text-accent hover:underline ml-1">
                                    {{ readDuration($post->title, $post->content) }} @choice('min|mins', readDuration($post->title, $post->content))
                                </a>
                            </li>
                        </ul>
                        <p>
                            {!! $post->content !!}
                        </p>
                        <a href="{{ route('read_post', $post->slug) }}">Đọc thêm</a>

                    </div>
                @endforeach
            @endif


            <!-- Sidebar -->
            <aside class="space-y-8">

                <!-- Search -->
                <div>
                    <h3 class="font-semibold mb-2">Tìm kiếm</h3>
                    <div class="flex">
                        <input type="text" placeholder="Type to discover articles..."
                            class="border border-border px-3 py-2 w-full rounded-l" />

                        <button type="submit"
                            class="text-white bg-accent px-5 py-2 rounded-r-md text-sm font-medium hover:bg-opacity-90 transition-all flex items-center justify-center whitespace-nowrap">
                            Tìm kiếm
                        </button>
                    </div>
                </div>

                <!-- Categories -->
                <div>
                    <h3 class="font-semibold mb-2">Danh mục</h3>
                    <ul class="text-sm text-textSub space-y-2">
                        <li class="flex justify-between"><span>Frontend Frameworks</span><span>(4)</span></li>
                        <li class="flex justify-between"><span>Mobile App Development</span><span>(12)</span></li>
                        <li class="flex justify-between"><span>Cybersecurity Essentials</span><span>(19)</span></li>
                        <li class="flex justify-between"><span>Backend Development</span><span>(3)</span></li>
                    </ul>
                </div>

                <!-- Tags -->
                <div>
                    <h3 class="font-semibold mb-2">Tags</h3>
                    <div class="flex flex-wrap gap-2 text-sm">
                        <span class="border px-3 py-1 rounded">Laravel</span>
                        <span class="border px-3 py-1 rounded">CodingTips</span>
                        <span class="border px-3 py-1 rounded">JavaScript</span>
                        <span class="border px-3 py-1 rounded">AI</span>
                    </div>
                </div>

            </aside>
        </section>

        <section class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            <div class="lg:col-span-2 space-y-10">

                <article class="flex gap-6">
                    <img class="w-52 h-36 object-cover rounded"
                        src="https://images.unsplash.com/photo-1587620962725-abab7fe55159">
                    <div>
                        <h2 class="text-xl font-bold mb-2">
                            Getting Started with Laravel: Your First Project Setup
                        </h2>
                        <p class="text-sm text-textSub mb-2">
                            Mark Wood · June 11, 2024 · Web Design
                        </p>
                        <p class="text-sm text-textSub mb-4">
                            Learn the step-by-step process to install and configure your first Laravel project...
                        </p>
                        <a class="border px-4 py-1.5 rounded text-sm" href="#">Read More...</a>
                    </div>
                </article>

                <article class="flex gap-6">
                    <img class="w-52 h-36 object-cover rounded"
                        src="https://images.unsplash.com/photo-1535223289827-42f1e9919769">
                    <div>
                        <h2 class="text-xl font-bold mb-2">
                            Building a Simple CRUD Application with PHP and MySQL
                        </h2>
                        <p class="text-sm text-textSub mb-2">
                            Mark Wood · June 22, 2024 · PHP
                        </p>
                        <p class="text-sm text-textSub mb-4">
                            Learn how to create a CRUD application with PHP and MySQL...
                        </p>
                        <a class="border px-4 py-1.5 rounded text-sm" href="#">Read More...</a>
                    </div>
                </article>

            </div>

            <!-- RIGHT SIDEBAR -->
            <aside>
                <h3 class="font-bold mb-4 border-b pb-2">Latest Articles</h3>

                <div class="space-y-4">
                    <div class="flex gap-3">
                        <img class="w-14 h-14 rounded object-cover"
                            src="https://images.unsplash.com/photo-1518770660439-4636190af475">
                        <div>
                            <p class="text-sm font-semibold">Optimizing CodeIgniter</p>
                            <span class="text-xs text-textSub">June 10, 2024</span>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <img class="w-14 h-14 rounded object-cover"
                            src="https://images.unsplash.com/photo-1555066931-4365d14bab8c">
                        <div>
                            <p class="text-sm font-semibold">CSS Animations</p>
                            <span class="text-xs text-textSub">June 27, 2024</span>
                        </div>
                    </div>
                </div>
            </aside>

        </section>

    </main>
@endsection
