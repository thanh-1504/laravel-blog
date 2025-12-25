@extends('back.layout.pages-layout')
@section('pageTitle', 'Sửa bài viết')
@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Sửa bài viết</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">Trang chủ</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Sửa bài viết
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <a href="{{ route('posts') }}" class="btn btn-primary">Xem tất cả bài viết</a>
            </div>
        </div>
    </div>

    <form action="{{ route('update_post', ['post_id' => $post->id]) }}" method="POST" autocomplete="off"
        enctype="multipart/form-data" id="updatePostForm">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="card card-box mb-2">
                    <div class="card-body">
                        <div class="form-group">
                            <label for=""><b>Tiêu đề</b>:</label>
                            <input type="text" class="form-control" name="title" placeholder="Nhập tiêu đề bài viết"
                                value="{{ $post->title }}">
                            <span class="text-danger error-text title_error"></span>
                        </div>
                        <div class="form-group">
                            <label for=""><b>Nội dung</b>:</label>
                            <textarea name="content" id="content" cols="30" rows="10" class="form-control ckeditor"
                                placeholder="Nhập nội dung bài viết">{!! $post->content !!}</textarea>
                            <span class="text-danger error-text content_error"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-box mb-2">
                    <div class="card-body">
                        <div class="form-group">
                            <label for=""><b>Phân loại bài viết</b>:</label>
                            <select name="category" class="custom-select form-control" id="">
                                {!! $categories_html !!}
                            </select>
                            <span class="text-danger error-text category_error"></span>
                        </div>
                        <div class="form-group">
                            <label for=""><b>Ảnh bài viết</b>:</label>
                            <input type="file" name="featured_image" class="form-control-file form-control"
                                height="auto" id="">
                            <span class="text-danger error-text featured_image_error"></span>
                        </div>
                        <div class="d-block mb-3" style="max-width: 250px;">
                            <img src="" alt="" class="img-thumbnail" id="featured_image_preview"
                                data-default-img="/images/posts/{{ $post->featured_image }}">
                        </div>
                        <div class="form-group">
                            <label for=""><b>Tags</b>:</label>
                            <input type="text" name="tags" class="form-control" data-role="tagsinput"
                                value="{{ $post->tags }}">
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for=""><b>Hiển thị</b>:</label>
                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" name="visibility" id="customRadio1" value="1"
                                    {{ $post->visibility == 1 ? 'checked' : '' }} class="custom-control-input">
                                <label for="customRadio1" class="custom-control-label">Công khai</label>
                            </div>
                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" name="visibility" id="customRadio2" value="0"
                                    class="custom-control-input" {{ $post->visibility == 0 ? 'checked' : '' }}>
                                <label for="customRadio2" class="custom-control-label">Riêng tư</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Sửa bài viết</button>
        </div>
    </form>
@endsection
@push('stylesheets')
    <link rel="stylesheet" href="/back/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css">
@endpush
@push('scripts')
    <script src="/back/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
    <script src="/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content', {
            filebrowserUploadUrl: "{{ route('ckeditor.upload') }}?_token={{ csrf_token() }}",
            filebrowserUploadMethod: 'form'
        });
    </script>
    <script>
        // TẠO BÀI VIẾT
        $("#updatePostForm").on("submit", function(e) {
            e.preventDefault();
            const form = this;
            const content = CKEDITOR.instances.content.getData();
            const formdata = new FormData(form);
            formdata.append("content", content);
            $.ajax({
                url: $(form).attr("action"),
                method: $(form).attr("method"),
                data: formdata,
                processData: false,
                dataType: "json",
                contentType: false,
                beforeSend: function() {
                    $(form).find("span.error-text").text("");
                },
                success: function(data) {
                    if (data.status == 1) {
                        Swal.fire({
                            icon: "success",
                            title: "Thành công",
                            text: data.message,
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Lỗi",
                            text: data.message
                        });
                    }
                },
                error: function(data) {
                    $.each(data.responseJSON.errors, function(prefix, val) {
                        $(form).find("span." + prefix + "_error").text(val[0]);
                    })
                }

            })
        });
    </script>
@endpush
