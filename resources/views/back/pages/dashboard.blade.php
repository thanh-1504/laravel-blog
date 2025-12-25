@extends('back.layout.pages-layout')
@section('content')
    <div class="main-container">
        <div class="pd-ltr-20">
            <div class="card-box pd-20 height-100-p mb-30">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <img src="{{ asset('back/vendors/images/banner-img.png') }}" alt="">
                    </div>
                    <div class="col-md-8">
                        <h4 class="font-20 weight-500 mb-10 text-capitalize">
                            Chào mừng quay trở lại, <div class="weight-600 font-30 text-blue">{{ auth()->user()->name }}!
                            </div>
                        </h4>
                        <p class="font-18 max-width-600">Hôm nay là một ngày tuyệt vời để viết những nội dung mới. Bạn hiện
                            đang có <b>{{ $posts_count }}</b> bài viết đang hoạt động trên hệ thống.</p>
                    </div>
                </div>
            </div>

            <div class="row pb-10">
                <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                    <div class="card-box height-100-p widget-style3">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark">{{ $posts_count }}</div>
                                <div class="font-14 text-secondary weight-500">Tổng bài viết</div>
                            </div>
                            <div class="widget-icon">
                                <div class="icon" data-color="#00eccf"><i class="icon-copy dw dw-newspaper"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                    <div class="card-box height-100-p widget-style3">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark">{{ $categories_count }}</div>
                                <div class="font-14 text-secondary weight-500">Danh mục</div>
                            </div>
                            <div class="widget-icon">
                                <div class="icon" data-color="#ff5b5b"><i class="icon-copy dw dw-list"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                    <div class="card-box height-100-p widget-style3">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark">{{ $users_count }}</div>
                                <div class="font-14 text-secondary weight-500">Tài khoản</div>
                            </div>
                            <div class="widget-icon">
                                <div class="icon" data-color="#09cc06"><i class="icon-copy dw dw-user-1"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                    <div class="card-box height-100-p widget-style3">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark">0</div>
                                <div class="font-14 text-secondary weight-500">Bình luận</div>
                            </div>
                            <div class="widget-icon">
                                <div class="icon" data-color="#ffc107"><i class="icon-copy dw dw-chat-3"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 col-md-12 mb-30">
                    <div class="card-box pd-20 height-100-p">
                        <h4 class="mb-20 h4">Bài viết mới nhất</h4>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Ảnh</th>
                                    <th>Tiêu đề</th>
                                    <th>Danh mục</th>
                                    <th>Ngày tạo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recent_posts as $post)
                                    <tr>
                                        <td class="table-plus">
                                            <img src="/images/posts/{{ $post->featured_image }}" width="50"
                                                height="50" alt="" class="rounded">
                                        </td>
                                        <td><span class="line-clamp-1">{{ $post->title }}</span></td>
                                        <td>{{ $post->post_category->name }}</td>
                                        <td>{{ $post->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 mb-30">
                    <div class="card-box pd-20 height-100-p">
                        <h4 class="mb-20 h4">Thao tác nhanh</h4>
                        <div class="list-group">
                            <a href="{{ route('add_post') }}"
                                class="list-group-item list-group-item-action d-flex align-items-center">
                                <i class="dw dw-add-file-1 mr-2 text-blue"></i> Viết bài mới
                            </a>
                            <a href="{{ route('profile') }}"
                                class="list-group-item list-group-item-action d-flex align-items-center">
                                <i class="dw dw-user1 mr-2 text-success"></i> Cập nhật hồ sơ
                            </a>
                            <a href="/" target="_blank"
                                class="list-group-item list-group-item-action d-flex align-items-center">
                                <i class="dw dw-eye mr-2 text-warning"></i> Xem trang chủ Blog
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
