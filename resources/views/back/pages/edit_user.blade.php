@extends('back.layout.pages-layout')
@section('pageTitle', 'Sửa tài khoản')
@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Sửa tài khoản</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">Trang chủ</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Sửa tài khoản
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <a href="{{ route('users') }}" class="btn btn-primary">Xem tất cả tài khoản</a>
            </div>
        </div>
    </div>

    <form action="{{ route('update_user', ['user_id' => $user->id]) }}" method="POST" autocomplete="off"
        enctype="multipart/form-data" id="updateUserForm">
        @csrf
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <div class="row">
            <div class="col-md-9">
                <div class="card card-box mb-2">
                    <div class="card-body">
                        <div class="form-group">
                            <label for=""><b>Tên tài khoản</b>:</label>
                            <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                            <span class="text-danger error-text name_error"></span>
                        </div>
                        <div class="form-group">
                            <label for=""><b>Username</b>:</label>
                            <input type="text" class="form-control" name="username" value="{{ $user->username }}">
                            <span class="text-danger error-text username_error"></span>
                        </div>
                        <div class="form-group">
                            <label for=""><b>Mật khẩu</b>:</label>
                            <input type="password" name="password" id="password" placeholder="Nhập mật khẩu..."
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
                                <option value="admin" {{ $user->type == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ $user->type == 'user' ? 'selected' : '' }}>User</option>

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
                                <input type="radio" name="status" id="customRadio1" value="active"
                                    class="custom-control-input"
                                    {{ $user->status == \App\UserStatus::Active ? 'checked' : '' }}>
                                <label for="customRadio1" class="custom-control-label">Active</label>
                            </div>
                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" name="status" id="customRadio2" value="inactive"
                                    class="custom-control-input"
                                    {{ $user->status == \App\UserStatus::InActive ? 'checked' : '' }}>
                                <label for="customRadio2" class="custom-control-label">InActive</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Sửa tài khoản</button>
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
        $("#updateUserForm").on("submit", function(e) {
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
