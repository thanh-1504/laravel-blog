@extends('back.layout.pages-layout')
@section('pageTitle', 'Danh sách bài viết')
@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Bài viết</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">Trang chủ</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Danh sách bài viết
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <a href="{{ route('add_post') }}" class="btn btn-primary">
                    <i class="icon-copy bi bi-plus-circle"></i> Tạo bài viết
                </a>
            </div>
        </div>
    </div>

    @livewire('admin.posts')
@endsection
@push('scripts')
    <script>
        window.addEventListener("deletePost", function(event) {
            const id = event.detail[0].id;
            Swal.fire({
                title: "Thông báo",
                text: "Bài viết sẽ bị xóa vĩnh viễn!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Xóa",
                cancelButtonText: "Hủy"
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch("deletePostAction", [id]);
                }
            });
        })
    </script>
@endpush
