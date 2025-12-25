@extends('front.layout.pages-layout')
@section('pageTitle', 'Trang chủ')
@section('content')
    <main class="max-w-7xl mx-auto px-6 py-10">

        <div class="mb-10">
            <h1 class="text-3xl font-bold">
                <span class="text-textMain">Kết quả tìm kiếm:</span>
                <span class="text-accent">{{ $query }}</span>
            </h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            <div class="lg:col-span-2 space-y-12">
                @forelse ($posts as $post)
                    <article class="flex flex-col md:flex-row gap-6 group">
                        <div class="md:w-64 shrink-0">
                            <a href="#" class="block overflow-hidden rounded-xl shadow-sm">
                                <img src="/images/posts/{{ $post->featured_image }}"
                                    class="w-full h-44 object-cover group-hover:scale-105 transition-transform duration-500"
                                    alt="Post Thumbnail">
                            </a>
                        </div>

                        <div class="flex flex-col">
                            <a href="{{ route('read_post', $post->slug) }}"
                                class="text-xl font-bold mb-2 hover:text-accent transition-colors line-clamp-2">
                                {{ $post->title }}
                            </a>

                            <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-sm text-textSub mb-3">
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                    <a href="{{ route('author_posts', $post->author->username) }}"
                                        class="hover:text-accent">{{ $post->author->name }}</a>
                                </span>

                                <span class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                    Ngày tạo: {{ $post->created_at->format('d/m/Y') }}
                                </span>

                                <span class="flex items-center gap-1">
                                    <span class="font-medium text-textMain">Danh mục:</span>
                                    <a href="{{ route('category_posts', $post->post_category->slug) }}"
                                        class="text-accent hover:underline">
                                        {{ $post->post_category->name }}
                                    </a>
                                </span>

                                <span class="flex items-center gap-1 border-l border-gray-200">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg>
                                    {{ readDuration($post->title, $post->content) }} @choice('min|mins', readDuration($post->title, $post->content))
                                </span>
                            </div>

                            <div
                                class="text-textSub text-sm leading-relaxed mb-4 line-clamp-3 overflow-hidden line-clamp-2">

                                {!! $post->content !!}
                            </div>

                            <div>
                                <a href="{{ route('read_post', $post->slug) }}"
                                    class="inline-block border border-border text-textSub text-xs font-medium px-5 py-2 rounded-full hover:bg-accent hover:text-white hover:border-accent transition-all">
                                    Đọc thêm
                                </a>
                            </div>

                        </div>
                    </article>
                @empty
                    <p>
                        <span class="text-red-500">Không có bài viết nào</span>
                    </p>
                @endforelse



            </div>

            <aside class="space-y-10">
                <x-sidebar-search></x-sidebar-search>
                <x-sidebar-categories></x-sidebar-categories>


            </aside>

        </div>
    </main>
@endsection
