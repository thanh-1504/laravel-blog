<?php

namespace App\Livewire\Admin;

use App\Helpers\MailTrap;
use App\Models\User;
use App\Models\UserSocialLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public $tab = null;
    public $tabName = "personal_details";
    protected $queryString = ["tab" => ["keep" => true]];
    public $picture;

    public $name,$email,$username,$bio;
    public $current_password,$new_password,$new_password_confirmation;

    function selectTab($tab) {
        $this->tab = $tab;
    }

    function mount() {
        $this->tab = Request("tab") ? Request("tab") : $this->tabName;
        $user = User::findOrFail(auth()->id());
        $this->name = $user->name;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->bio = $user->bio;
    }

  public function updateProfilePicture()
{
    $user = User::findOrFail(auth()->id());
    $this->validate([
        'picture' => 'required|mimes:jpg,jpeg,png|max:1024'
    ]);
    if ($this->picture) {
        $path = 'images/users/';
        $file = $this->picture;
        $filename = $file->getClientOriginalName();
        $new_filename = time() . '_' . $filename;

        // Upload ảnh
        $upload = $file->storeAs(
            'public/'.$path,
            $new_filename
        );

        if ($upload) {

            if (
                $user->picture &&
                File::exists(public_path($path.$user->picture))
            ) {
                File::delete(public_path($path.$user->picture));
            }

            $user->picture = $new_filename;
            $user->save();
            $this->dispatch('showToastr', [
                'type' => 'success',
                'message' => 'Cập nhật ảnh đại diện thành công'
            ]);
            $this->reset('picture');
        } else {
            $this->dispatch('showToastr', [
                'type' => 'error',
                'message' => 'Upload ảnh thất bại'
            ]);
        }
    }
}



function updatePersonalDetails() {
    $user = User::findOrFail(auth()->id());

    $this->validate([
        "name" => "required",
        "username" => "required|unique:users,username," . $user->id,
        'picture' => 'nullable|image|max:2048', 
    ]);

    if ($this->picture) {
        $path = 'images/users'; 
        $destinationPath = public_path($path);

        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true);
        }

        $filename = time() . '_' . $this->picture->getClientOriginalName();

   
        $tempPath = $this->picture->getRealPath();
        File::copy($tempPath, $destinationPath . '/' . $filename);

        if ($user->picture && File::exists($destinationPath . '/' . $user->picture)) {
            File::delete($destinationPath . '/' . $user->picture);
        }
        $user->picture = $filename;
    }

    $user->name = $this->name;
    $user->username = $this->username;
    $user->bio = $this->bio;
    
    $updated = $user->save();

    if ($updated) {
        $this->dispatch("showToastr", type: "success", message: "Cập nhật hồ sơ thành công");
        $this->dispatch("updateTopUserInfo")->to(TopUserInfo::class);
        $this->reset('picture');
    }
}    function updatePassword() {
        $user = User::findOrFail(auth()->id());
      $this->validate([
            "current_password" => [
                "required",
                "min:5",
                function($attribute, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        return $fail(__("Mật khẩu hiện tại không đúng."));
                    }
                }
            ],
            "new_password" => "required|min:5|confirmed",
        ], [
            'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại.',
            'current_password.min' => 'Mật khẩu phải từ 5 ký tự trở lên.',
            'new_password.required' => 'Vui lòng nhập mật khẩu mới.',
            'new_password.min' => 'Mật khẩu mới phải từ 5 ký tự trở lên.',
            'new_password.confirmed' => 'Xác nhận mật khẩu mới không khớp.'
        ]);
       $data = [
            "password" => Hash::make($this->new_password),
        ];
    if ($this->picture) {
        $path = 'images/users';
        $destinationPath = public_path($path);
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true);
        }
        $filename = time() . '_' . $this->picture->getClientOriginalName();
        $tempPath = $this->picture->getRealPath();
        File::copy($tempPath, $destinationPath . '/' . $filename);
        if ($user->picture && File::exists($destinationPath . '/' . $user->picture)) {
            File::delete($destinationPath . '/' . $user->picture);
        }
        $data['picture'] = $filename;
    }
        $updated = $user->update($data);
        if ($updated) {
            $data = array(
                "user" => $user,
                "new_password" => $this->new_password
            );
            $mail_body = view("email-templates.password-changes-template",$data)->render();
            $mail_config = array(
                "recipient_address" => $user->email,
                "recipient_name" => $user->name,
                "subject" => "Password Changed",
                "body" => $mail_body
            );
            MailTrap::send($mail_config);
            auth()->logout();
            Session::flash("info", "Đổi mật khẩu thành công");
             $this->redirectRoute("login");
        } else {
            $this->dispatch("showToastr",["type" => "error","message" => "Something went wrong"]);
        }
    }

   
    public function render()
    {
        return view('livewire.admin.profile',[
            "user" => User::findOrFail(auth()->id())
        ]);
    }
}
