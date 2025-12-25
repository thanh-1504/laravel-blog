@extends('front.layout.pages-layout')
@section('content')
    <main class="max-w-7xl mx-auto px-6 py-10">

        <div class="flex flex-col items-center text-center mb-16">
            <img src="{{ $author->picture }}" alt="Author Avatar"
                class="w-32 h-32 rounded-full object-cover mb-4 shadow-md border-4 border-white">

            <h2 class="text-3xl font-bold text-accent mb-2">{{ $author->name }}</h2>

            <p class="text-lg font-medium text-textMain mb-4">{{ $author->username }}</p>

            <p class="max-w-2xl text-textSub mb-6 leading-relaxed">
                {{ $author->bio }}
            </p>



        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-6 gap-y-10">

            @forelse ($posts as $post)
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
                                <span class="font-medium mr-1">Ngày tạo :</span> {{ date_formatter($post->created_at) }}
                            </p>
                            <a href="{{ route('category_posts', $post->post_category->slug) }}" class="flex items-center">
                                <span class="font-medium mr-1">Danh mục :</span> {{ $post->post_category->name }}
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <span class="text-red-500 text-center">
                    Không có bài viết nào
                </span>
            @endforelse



        </div>



    </main>
@endsection
