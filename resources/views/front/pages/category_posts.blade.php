@extends('front.layout.pages-layout')
@section('content')
    <main class="max-w-7xl mx-auto px-6 py-10">

        <div class="mb-12">
            <h1 class="text-3xl font-bold text-accent">{{ $category->name }}</h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-6 gap-y-10">

            @if ($posts->count())
                @foreach ($posts as $post)
                    <div class="flex flex-col group">
                        <div class="overflow-hidden rounded-2xl mb-4 shadow-sm bg-gray-100">
                            <img src="/images/posts/{{ $post->featured_image }}" alt="Post title"
                                class="w-full h-44 object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>

                        <div class="flex flex-col flex-grow">
                            <a href="{{ route('read_post', $post->slug) }}"
                                class="text-[17px] font-bold leading-snug mb-3 hover:text-accent transition-colors line-clamp-2">
                                {{ $post->title }}
                            </a>

                            <div class="text-[13px] text-textSub space-y-1 mt-auto">
                                <p class="flex items-center">
                                    <span class="font-medium mr-1">Ngày tạo :</span>
                                    {{ date_formatter($post->created_at) }}
                                </p>
                                <p class="flex items-center">
                                    <a href="{{ route('author_posts', $post->author->username) }}"
                                        class="font-medium mr-1">Tác giả :</a> {{ $post->author->name }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>
                    <span class="text-danger">Không có bài viết nào</span>
                </p>
            @endif


        </div>


    </main>
@endsection
