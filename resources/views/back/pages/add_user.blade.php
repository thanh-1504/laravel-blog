@extends('back.layout.pages-layout')
@section('pageTitle', 'Add new user')
@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Thêm tài khoản</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">Trang chủ</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Tạo tài khoản
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <a href="{{ route('users') }}" class="btn btn-primary">Xem tất cả tài khoản</a>
            </div>
        </div>
    </div>

    <form action="{{ route('create_user') }}" method="POST" autocomplete="off" enctype="multipart/form-data"
        id="addUserForm">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="card card-box mb-2">
                    <div class="card-body">
                        <div class="form-group">
                            <label for=""><b>Tên tài khoản</b>:</label>
                            <input type="text" class="form-control" name="name" placeholder="Nhập tên tài khoản">
                            <span class="text-danger error-text name_error"></span>
                        </div>
                        <div class="form-group">
                            <label for=""><b>Email</b>:</label>
                            <input type="text" class="form-control" name="email" placeholder="Nhập email">
                            <span class="text-danger error-text email_error"></span>
                        </div>
                        <div class="form-group">
                            <label for=""><b>Mật khẩu</b>:</label>
                            <input type="password" name="password" id="password" placeholder="Nhập mật khẩu"
                                class="form-control">
                            <span class="text-danger error-text password_error"></span>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-box mb-2">
                    <div class="card-body">
                        <div class="form-group">
                            <label for=""><b>Phân loại tài khoản</b>:</label>
                            <select name="type" class="custom-select form-control" id="">
                                <option value="">Chọn phân loại ...</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                            <span class="text-danger error-text type_error"></span>
                        </div>
                        <div class="form-group">
                            <label for=""><b>Ảnh tài khoản</b>:</label>
                            <input type="file" name="picture" class="form-control-file form-control" height="auto"
                                id="">
                            <span class="text-danger error-text picture_error"></span>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for=""><b>Tình trạng</b>:</label>
                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" name="status" id="customRadio1" value="active" checked
                                    class="custom-control-input">
                                <label for="customRadio1" class="custom-control-label">Active</label>
                            </div>
                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" name="status" id="customRadio2" value="inactive"
                                    class="custom-control-input">
                                <label for="customRadio2" class="custom-control-label">InActive</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Tạo tài khoản</button>
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
        // TẠO TÀI KHOẢN
        $("#addUserForm").on("submit", function(e) {
            e.preventDefault();
            const form = this;
            const formdata = new FormData(form);
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
                        $(form)[0].reset();
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
