<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class Users extends Component
{
      public $categories_html;
    public $search = null;
    public $author = null;
    public $category = null;
    public $visibility = null;
    public $post_visibility;
    public $sortBy = "desc";

    protected $listeners = [
        "deleteUserAction"
    ];



    function deleteUser($id) {
        $this->dispatch("deleteUser",["id" => $id]);
    }

    public function deleteUserAction($id)
    {
        $user = User::findOrFail($id);
        if ($user->deleted_at) {
             $this->dispatch("showToastr", [
            "type" => "warning",
            "message" => "Tài khoản này đã bị vô hiệu hóa trước đó"
            ]);
             return;
        }
        $user->status = 'inactive';
        $user->save();
        $user->delete(); 
       $this->dispatch('showToastr',type: 'success',message: 'Xóa tài khoản thành công');

    }
    public function render()
    {
         return view('livewire.admin.users', [
        "users" => User::withTrashed()
            ->where("type", "!=", "superAdmin")
            ->orderBy("id", "asc")
            ->get()
    ]);
    }
  
}
