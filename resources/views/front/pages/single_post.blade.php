@extends('front.layout.pages-layout')
@section('pageTitle', $post->title)

@section('content')
    <main class="max-w-7xl mx-auto px-6 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2">
                <h2 class="text-3xl md:text-4xl font-bold text-textMain leading-tight mb-6">
                    {{ $post->title }}
                </h2>
                <ul
                    class="flex flex-wrap items-center gap-x-6 gap-y-3 text-sm text-textSub mb-8 pb-6 border-b border-border">
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path
                                d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"
                                stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <a class="font-medium"
                            href="{{ route('author_posts', $post->author->username) }}">{{ $post->author->name }}</a>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path
                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"
                                stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        Ngày tạo: {{ $post->created_at->format('d/m/Y') }}
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="text-textMain font-medium">Danh mục:</span>
                        <a href="{{ route('category_posts', $post->post_category->slug) }}" class="text-accent">
                            {{ $post->post_category->name }}</a>
                    </li>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="text-textMain font-medium">Thời gian đọc:</span>
                        <span class="flex items-center gap-1 border-l border-gray-200">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                            {{ readDuration($post->title, $post->content) }} @choice('min|mins', readDuration($post->title, $post->content))
                        </span>
                    </li>
                </ul>

                <div class="mb-10">
                    <img src="/images/posts/{{ $post->featured_image }}"
                        class="w-full h-auto rounded-2xl shadow-sm object-cover max-h-[500px]" alt="Featured Image">
                </div>

                <div class="flex flex-col md:flex-row gap-8 mb-16">
                    <div class="flex-1 space-y-6 text-textMain leading-relaxed text-lg">
                        {!! $post->content !!}
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 py-8 border-y border-border mb-16">
                    <div class="flex flex-col items-start">
                        @if ($prevPost)
                            <span class="text-xs font-bold text-textSub uppercase mb-1">« Bài trước</span>
                            <a href="{{ route('read_post', $prevPost->slug) }}"
                                class="text-sm font-bold hover:text-accent transition-colors line-clamp-1">{{ $prevPost->title }}
                            </a>
                        @endif

                    </div>
                    <div class="flex flex-col items-end text-right border-l border-border pl-4">
                        @if ($nextPost)
                            <span class="text-xs font-bold text-textSub uppercase mb-1">Bài tiếp theo »</span>
                            <a href="{{ route('read_post', $nextPost->slug) }}"
                                class="text-sm font-bold hover:text-accent transition-colors line-clamp-1">{{ $nextPost->title }}
                            </a>
                        @endif

                    </div>
                </div>

                @if ($relatedPosts)
                    <div class="mb-10">
                        <h3 class="text-2xl font-bold mb-8">Các bài viết liên quan</h3>
                        @foreach ($relatedPosts as $post)
                            <div class="mb-10">
                                <div class="flex flex-col gap-y-12">
                                    <article class="flex flex-col md:flex-row gap-6 group">
                                        <div class="md:w-72 shrink-0">
                                            <img src="/images/posts/{{ $post->featured_image }}"
                                                class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500 rounded-lg"
                                                alt="Thumbnail">
                                        </div>
                                        <div class="flex flex-col justify-between">

                                            <a href="{{ route('read_post', $post->slug) }}"
                                                class="text-xl font-bold mb-3 block hover:text-accent transition-colors">
                                                {{ $post->title }}
                                            </a>
                                            <div>
                                                <div
                                                    class="flex flex-wrap items-center gap-x-4 gap-y-1 text-[13px] text-textSub mb-2">
                                                    <a href="{{ route('author_posts', $post->author->username) }}"
                                                        class="flex items-center gap-1 hover:text-accent">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                            stroke-width="2" viewBox="0 0 24 24">
                                                            <path
                                                                d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"
                                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                        {{ $post->author->name }}
                                                    </a>
                                                    <span class="flex items-center gap-1">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                            stroke-width="2" viewBox="0 0 24 24">
                                                            <path
                                                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"
                                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                        Ngày tạo: {{ $post->created_at->format('d/m/Y') }}
                                                    </span>
                                                    <a href="{{ route('category_posts', $post->post_category->slug) }}">Danh
                                                        mục: <span
                                                            class="text-accent font-medium">{{ $post->post_category->name }}</span>
                                                    </a>
                                                    <span class="flex items-center gap-1 ">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                            stroke-width="2" viewBox="0 0 24 24">
                                                            <path d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"
                                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                        {{ readDuration($post->title, $post->content) }} @choice('min|mins', readDuration($post->title, $post->content))
                                                    </span>
                                                </div>


                                                <p class="text-textSub text-sm leading-relaxed mb-4 line-clamp-2">
                                                    {{ Str::limit(strip_tags($post->content), 150) }}
                                                </p>
                                            </div>

                                            <div>
                                                <a href="{{ route('read_post', $post->slug) }}"
                                                    class="inline-block border border-border text-textSub text-xs font-medium px-6 py-2 rounded-full hover:bg-accent hover:text-white hover:border-accent transition-all">
                                                    Đọc thêm
                                                </a>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            </div>
                        @endforeach

                    </div>
                @endif

                <section class="comments overflow-hidden">
                    <div style="margin-top: -45px;">
                        <div id="disqus_thread"></div>
                        <script>
                            var disqus_config = function() {
                                this.language = 'vi';
                                this.page.url = "{{ route('read_post', $post->slug) }}";
                                this.page.identifier = "PID_" + "{{ $post->id }}";
                            };
                            (function() {
                                var d = document,
                                    s = d.createElement('script');
                                s.src = 'https://blog-rbgaakucqj.disqus.com/embed.js';
                                s.setAttribute('data-timestamp', +new Date());
                                (d.head || d.body).appendChild(s);
                            })();
                        </script>
                        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments
                                powered by Disqus.</a></noscript>
                    </div>

                </section>


            </div>

            <aside class="space-y-12 mt-2">
                <x-sidebar-search></x-sidebar-search>
                <x-sidebar-categories></x-sidebar-categories>
            </aside>

        </div>
    </main>
@endsection
