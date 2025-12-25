<div>
    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
            <div class="pd-20 card-box height-100-p">
                <div class="profile-photo">
                    <a href="javascript:;"
                        onclick="event.preventDefault();document.getElementById('profile_picture_input').click();"
                        class="edit-avatar">
                        <i class="fa fa-pencil"></i>
                    </a>

                    <img style="width: 100%;height: 100%;" src="{{ $picture ? $picture->temporaryUrl() : ($user->picture ? $user->picture: 'images/users/default-user.jfif') }}"
                        class="avatar-photo" />

                    <input type="file" id="profile_picture_input" class="d-none" wire:model="picture"
                        accept="image/*">
                </div>

                <h5 class="text-center h5 mb-0">{{ $user->name }}</h5>
                <p class="text-center text-muted font-14">
                    {{ $user->email }}
                </p>
            </div>
        </div>
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
            <div class="card-box height-100-p overflow-hidden">
                <div class="profile-tab height-100-p">
                    <div class="tab height-100-p">
                        <ul class="nav nav-tabs customtab" role="tablist">
                            <li class="nav-item">
                                <a wire:click="selectTab('personal_details')"
                                    class="nav-link {{ $tab == 'personal_details' ? 'active' : '' }}"
                                    style="cursor: pointer;">
                                    Thông tin cá nhân
                                </a>


                            </li>
                            <li class="nav-item">
                                <a wire:click="selectTab('update_password')"
                                    class="nav-link cursor-pointer {{ $tab == 'update_password' ? 'active' : '' }}"
                                    style="cursor: pointer;">
                                    Cập nhật mật khẩu
                                </a>

                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade {{ $tab == 'personal_details' ? 'show active' : '' }}"
                                id="personal_details" role="tabpanel">
                                <div class="pd-20">
                                    <form wire:submit="updatePersonalDetails()" action="">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Full name</label>
                                                    <input type="text" class="form-control" wire:model="name"
                                                        placeholder="Enter full name">
                                                    @error('name')
                                                        <span class="text-danger"> {{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Email</label>
                                                    <input type="email" class="form-control" wire:model="email"
                                                        disabled placeholder="Enter email address">
                                                    @error('email')
                                                        <span class="text-danger"> {{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Username</label>
                                                    <input type="text" class="form-control" wire:model="username"
                                                        @error('username')
                                                        <span class="text-danger"> {{ $message }}</span>
                                                    @enderror
                                                        </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">Bio</label>
                                                        <textarea wire:model="bio" cols="4" rows="4" class="form-control" placeholder="Type your bio"></textarea>
                                                        @error('bio')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                            </div>
                                    </form>
                                </div>
                            </div>

                            <div class="tab-pane fade  {{ $tab == 'update_password' ? 'show active' : '' }}"
                                id="update_password" role="tabpanel">
                                <div class="pd-20 profile-task-wrap">
                                    <form wire:submit="updatePassword()" action="">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Mật khẩu hiện tại</label>
                                                    <input type="password" class="form-control"
                                                        wire:model="current_password"
                                                        placeholder="Nhập mật khẩu hiện tại"
                                                        @error('current_password')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                        </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Mật khẩu mới</label>
                                                        <input type="password" class="form-control"
                                                            wire:model="new_password" placeholder="Nhập mật khẩu mới"
                                                            @error('new_password')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                            </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="">Xác nhận mật khẩu mới</label>
                                                            <input type="password" class="form-control"
                                                                wire:model="new_password_confirmation"
                                                                placeholder="Nhập lại mật khẩu xác nhận"
                                                                @error('new_password_confirmation')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                                </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade  {{ $tab == 'social_links' ? 'show active' : '' }}"
                                id="social_links" role="tabpanel">
                                <div class="pd-20 profile-task-wrap">
                                    <form method="post" wire:submit="updateSocialLinks()">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for=""><b>Facebook</b></label>
                                                    <input type="text" name="" id=""
                                                        class="form-control" wire:model="facebook_url"
                                                        placeholder="Facebook Url">
                                                    @error('facebook_url')
                                                        <span class="text-danger ml-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for=""><b>Instagram</b></label>
                                                    <input type="text" name="" id=""
                                                        class="form-control" wire:model="instagram_url"
                                                        placeholder="Instagram Url">
                                                    @error('instagram_url')
                                                        <span class="text-danger ml-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for=""><b>Youtube</b></label>
                                                    <input type="text" name="" id=""
                                                        class="form-control" wire:model="youtube_url"
                                                        placeholder="Youtube Url">
                                                    @error('youtube_url')
                                                        <span class="text-danger ml-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for=""><b>LinkedIn</b></label>
                                                    <input type="text" name="" id=""
                                                        class="form-control" wire:model="linkedin_url"
                                                        placeholder="LinkedIn Url">
                                                    @error('linkedin_url')
                                                        <span class="text-danger ml-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for=""><b>Twitter</b></label>
                                                    <input type="text" name="" id=""
                                                        class="form-control" wire:model="twitter_url"
                                                        placeholder="Twitter Url">
                                                    @error('twitter_url')
                                                        <span class="text-danger ml-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for=""><b>Github</b></label>
                                                    <input type="text" name="" id=""
                                                        class="form-control" wire:model="github_url"
                                                        placeholder="Github Url">
                                                    @error('github_url')
                                                        <span class="text-danger ml-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </form>
                                </div>
                            </div>

                            <!-- Setting Tab End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
