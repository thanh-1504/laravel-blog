@extends('back.layout.pages-layout')
@section('pageTitle', 'Danh sách tài khoản')
@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Danh sách tài khoản</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Trang chủ</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Danh sách tài khoản
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <a href="{{ route('add_user') }}" class="btn btn-primary">
                    <i class="icon-copy bi bi-plus-circle"></i> Tạo tài khoản
                </a>
            </div>
        </div>
    </div>
    @livewire('admin.users')
@endsection
@push('scripts')
    <script>
        window.addEventListener("deleteUser", function(event) {
            const id = event.detail[0].id;
            Swal.fire({
                title: "Thông báo",
                text: "Tài khoản sẽ bị xóa!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Xóa",
                cancelButtonText: "Hủy"
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch("deleteUserAction", [id]);
                }
            });
        })
    </script>
@endpush
