<div>
    <div class="row">
        <div class="col-12">
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="h4 text-blue">Danh mục cha</h4>
                    </div>
                    <div class="pull-right">
                        <a wire:click="addParentCategory()" href="javascript:;" class="btn btn-sm btn-primary">Thêm</a>
                    </div>
                </div>
                <div class="table-responsive mt-4">
                    <table class="table table-borderless table-striped table-sm">
                        <thead class="bg-secondary text-white">
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Số danh mục con</th>
                            <th>Hành động</th>
                        </thead>
                        <tbody >
                            @forelse ($pcategories as $item)
                                <tr >
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td> {{ $item->hasCategories->count() }} </td>
                                    <td>
                                        <div class="table-actions">
                                            <a wire:click="editParentCategory({{ $item->id }})" href="javascript:;"
                                                class="text-primary mx-2">
                                                <i class="dw dw-edit2"></i>
                                            </a>
                                            <a wire:click="deleteParentCategory({{ $item->id }})"
                                                href="javascript:;" class="text-danger mx-2">
                                                <i class="dw dw-delete-3"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">
                                        <span class="text-danger">
                                            Không có danh mục nào!
                                        </span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <div class="col-12">
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="h4 text-blue">Danh mục con</h4>
                    </div>
                    <div class="pull-right">
                        <a wire:click="addCategory()" href="javascript:;" class="btn btn-sm btn-primary">Thêm</a>
                    </div>
                </div>
                <div class="table-responsive mt-4">
                    <table class="table table-borderless table-striped table-sm">
                        <thead class="bg-secondary text-white">
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Danh mục cha</th>
                            <th>Số lượng bài viết</th>
                            <th>Hành động</th>
                        </thead>
                        <tbody>
                            @forelse ($categories as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        {{ $item->parent_category ? $item->parent_category->name : '-' }}
                                    </td>

                                    <td>{{ $item->posts->count() }}</td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="javascript:;" wire:click="editCategory({{ $item->id }})"
                                                class="text-primary mx-2">
                                                <i class="dw dw-edit2"></i>
                                            </a>
                                            <a href="javascript:;" wire:click="deleteCategory({{ $item->id }})"
                                                class="text-danger mx-2">
                                                <i class="dw dw-delete-3"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">
                                        <span class="text-danger">
                                            Không có danh mục nào !
                                        </span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    {{-- MODALS --}}
    <div wire:ignore.self class="modal fade" id="pcategory_modal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content"
                wire:submit="{{ $isUpdateParentCategoryMode ? 'updateParentCategory()' : 'createParentCategory()' }}">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        {{ $isUpdateParentCategoryMode ? 'Cập nhật danh mục cha' : 'Thêm danh mục cha' }}
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    @if ($isUpdateParentCategoryMode)
                        <input type="hidden" name="" wire:model="pcategory_id">
                    @endif
                    <div class="form-group">
                        <label for="">
                            <b>Tên danh mục cha</b>
                        </label>
                        <input type="text" name="" id="" class="form-control"
                            wire:model="pcategory_name" placeholder="Nhập tên danh mục cha">
                        @error('pcategory_name')
                            <span class="text-danger ml-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        {{ $isUpdateParentCategoryMode ? 'Lưu' : 'Thêm' }}
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Hủy
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="category_modal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content"
                wire:submit="{{ $isUpdateCategoryMode ? 'updateCategory()' : 'createCategory()' }}">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        {{ $isUpdateCategoryMode ? 'Cập nhật danh mục' : 'Thêm danh mục' }}
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                    </button>
                </div>
                <div class="modal-body">
                    @if ($isUpdateCategoryMode)
                        <input type="hidden" name="" wire:model="category_id">
                    @endif
                    <div class="form-group">
                        <label for="">
                            <b>Chọn danh mục cha</b>
                        </label>
                        <select wire:model="parent" class="custom-select">
                            <option value="">Không có danh mục</option>
                            @foreach ($pcategories as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('parent')
                            <span class="text-danger ml-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">
                            <b>Tên danh mục</b>
                        </label>
                        <input type="text" name="" id="" class="form-control"
                            wire:model="category_name" placeholder="Nhập tên danh mục">
                        @error('category_name')
                            <span class="text-danger ml-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Đóng
                    </button>
                    <button type="submit" class="btn btn-primary">
                        {{ $isUpdateCategoryMode ? 'Lưu' : 'Tạo' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
