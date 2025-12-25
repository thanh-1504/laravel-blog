<div>
    <div class="pd-20 card-box mb-30">
        <div class="row mb-20">
            <div class="col-md-4">
                <label for="search"><b class="text-secondary">Tìm kiếm</b>:</label>
                <input wire:model.live="search" type="text" id="search" class="form-control"
                    placeholder="Tìm kiếm bài viết...">
            </div>
            @if (auth()->user()->type == 'superAdmin')
                <div class="col-md-2">
                    <label for="author"><b class="text-secondary">Tác giả</b></label>
                    <select wire:model.live="author" id="author" class="custom-select form-control">
                        <option value="">Tất cả</option>
                        @foreach (App\Models\User::whereHas('posts')->get() as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            <div class="col-md-2">
                <label for="category"><b class="text-secondary">Danh mục</b></label>
                <select wire:model.live="category" id="category" class="custom-select form-control">
                    <option value="">Tất cả</option>
                    {!! $categories_html !!}
                </select>
            </div>
            <div class="col-md-2">
                <label for="visibility"><b class="text-secondary">Chế độ hiển thị</b></label>
                <select wire:model.live="visibility" id="visibility" class="custom-select form-control">
                    <option value="">Tất cả</option>
                    <option value="public">Công khai</option>
                    <option value="private">Riêng tư</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="sort"><b class="text-secondary">Sắp xếp theo</b></label>
                <select wire:model.live="sortBy" id="sort" class="custom-select form-control">
                    <option value="asc">Tăng dần</option>
                    <option value="desc">Giảm dần</option>
                </select>
            </div>

        </div>
        <div class="table-responsive">
            <table class="table table-striped table-auto table-sm">
                <thead class="bg-secondary text-white">
                    <th scope="col">#ID</th>
                    <th scope="col">Ảnh</th>
                    <th scope="col">Tiêu đề</th>
                    <th scope="col">Tác giả</th>
                    <th scope="col">Danh mục</th>
                    <th scope="col">Chế độ hiển thị</th>
                    <th scope="col">Hành động</th>
                </thead>
                <tbody>
                    @forelse ($posts as $item)
                        <tr>
                            <td scope="row">{{ $item->id }}</td>
                            <td>
                                <a href="">
                                    <img src="/images/posts/{{ $item->featured_image }}" width="100" alt="">
                                </a>
                            </td>
                            <td>{{ $item->title }}</td>
                            <td> {{ $item->author->name }} </td>
                            <td> {{ $item->post_category->name }} </td>
                            <td>
                                @if ($item->visibility == 1)
                                    <span class="badge badge-pill badge-success">
                                        <i class="icon-copy ti-world"></i> Công khai
                                    </span>
                                @else
                                    <span class="badge badge-pill badge-warning">
                                        <i class="icon-copy ti-lock"></i> Cá nhân
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('edit_post', ['id' => $item->id]) }}" data-color="#265ed7"
                                        style="color:rgb(38,94,215)">
                                        <i class="icon-copy dw dw-edit2"></i>
                                    </a>
                                    <a href="javascript:;" wire:click="deletePost({{ $item->id }})"
                                        data-color="#e95959" style="color:rgb(233,89,89)">
                                        <i class="icon-copy dw dw-delete-3"></i>
                                    </a>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <span class="text-danger">Không có bài viết nào được tìm thấy</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
