<div>
    <div class="pd-20 card-box mb-30">
        <div class="row mb-20">
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-auto table-sm">
                <thead class="bg-secondary text-white">
                    <th scope="col">ID</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Email</th>
                    <th scope="col">Username</th>
                    <th scope="col">Loại</th>
                    <th scope="col">Tình trạng</th>
                    <th scope="col">Hành động</th>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr wire:key="user-{{ $user->id }}">
                            <td scope="row">{{ $user->id }}</td>
                            <td> {{ $user->name }} </td>
                            <td> {{ $user->email }} </td>
                            <td> {{ $user->username }} </td>
                            <td> {{ $user->type }} </td>
                            <td>
                                @if ($user->status == \App\UserStatus::Active)
                                    <span class="badge badge-pill badge-success">
                                        <i class="icon-copy ti-world"></i> Hoạt động
                                    </span>
                                @else
                                    <span class="badge badge-pill badge-warning">
                                        <i class="icon-copy ti-lock"></i> Không hoạt động
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('edit_user', ['id' => $user->id]) }}" data-color="#265ed7"
                                        style="color:rgb(38,94,215)">
                                        <i class="icon-copy dw dw-edit2"></i>
                                    </a>
                                    @if ($user->trashed())
                                        <a style="pointer-events: none" href="javascript:;" data-color="#cccccc" style="color: #cccccc">
                                            <i class="icon-copy dw dw-delete-3"></i>
                                        </a>
                                    @else
                                        <a href="javascript:;" wire:click="deleteUser({{ $user->id }})"
                                            data-color="#e95959" style="color: #e95959">
                                            <i class="icon-copy dw dw-delete-3"></i>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <span class="text-danger">Không có tài khoản nào được tìm thấy</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
