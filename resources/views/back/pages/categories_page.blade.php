@extends('back.layout.pages-layout')
@section('pageTitle', 'Manage Categories')
@section('content')
    @livewire('admin.categories')
@endsection
@push('scripts')
    <script>
        window.addEventListener("showParentCategoryModalForm", function(e) {
            $("#pcategory_modal").modal('show')
        })

        window.addEventListener("hideParentCategoryModalForm", function(e) {
            $("#pcategory_modal").modal('hide')
        })

        window.addEventListener("showCategoryModalForm", function(e) {
            $("#category_modal").modal('show')
        })

        window.addEventListener("hideCategoryModalForm", function(e) {
            $("#category_modal").modal('hide')
        })

        window.addEventListener('deleteParentCategory', function(event) {
            let id = event.detail[0].id;
            Swal.fire({
                title: 'Thông báo',
                html: 'Bạn có chắc chắn muốn xóa?',
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Hủy',
                confirmButtonText: 'Đồng ý',
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                width: 320,
                allowOutsideClick: false,
                fontSize: '1rem'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch("deleteParentCategoryAction", [id]);
                }
            });
        });

        window.addEventListener("deleteCategory", function(event) {
            const id = event.detail[0].id;
            Swal.fire({
                title: 'Thông báo',
                html: 'Bạn có chắc chắn muốn xóa',
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Không',
                confirmButtonText: 'Có',
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                width: 320,
                allowOutsideClick: false,
                fontSize: '1rem'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch("deleteCategoryAction", [id]);
                }
            });
        })
    </script>
@endpush
