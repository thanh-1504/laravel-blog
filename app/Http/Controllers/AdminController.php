<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    function adminDashboard(Request $request) {
        $data = [
            'posts_count' => Post::count(),
            'categories_count' => Category::count(),
            'users_count' => User::count(),
            'recent_posts' => Post::with('post_category')
                                ->orderBy('created_at', 'desc')
                                ->take(5)
                                ->get(),
        ];
        return view("back.pages.dashboard",$data);
    }

     function logoutHandle(Request $request) {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        if (isset($request->source)) {
            return redirect()->back();
        }
        return redirect()->route("login")->with("fail","Bạn đã đăng xuất !");
    }

    function profileView(Request $request) {
        $data = [
            "pageTitle" => "Hồ sơ"
        ];
        return view("back.pages.profile", $data);
    }

    function getadminGetUsersView() {
          
        return view("back.pages.users");
    }

    function addUser (Request $request) {
        return view("back.pages.add_user");
    }

   function createUser(Request $request) {
   $request->validate(
    [
        "name" => "required",
        "email" => "required|email|unique:users,email",
        "password" => "required|min:5",
    ],
    [
        "name.required" => "Tên tài khoản không được để trống",
        "email.required" => "Email không được để trống",
        "email.email" => "Email không đúng định dạng",
        "email.unique" => "Email đã tồn tại",
        "password.required" => "Mật khẩu không được để trống",
        "password.min" => "Mật khẩu phải có ít nhất 5 ký tự",
    ]
);
    $user = new User();
    $user->name = $request->name;
    $user->username = explode('@', $request->email)[0];
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->type = $request->type ? $request->type : UserType::User;
    $user->status = $request->status;
    if ($request->hasFile("picture")) {
        $path = "images/users";
        $file = $request->file("picture");
        $new_filename = time() . "_" . $file->getClientOriginalName();
        $file->move(public_path($path), $new_filename);
        $user->picture = $new_filename;
    }
    if ($user->save()) {
        return response()->json([
            "status" => 1,
            "message" => "Tạo tài khoản thành công"
        ]);
    }

    return response()->json([
        "status" => 0,
        "message" => "Tạo tài khoản thất bại"
    ]);
}

function editUser($id = null) {
    $user = $user = User::withTrashed()->findOrFail($id);
    $data = [
        "user" => $user,
    ];
    return view("back.pages.edit_user",$data);
}

public function updateUser(Request $request){
    $user = User::withTrashed()->findOrFail($request->user_id);
    $request->validate(
        [
            "name" => "nullable",
            "password" => "nullable|min:5",
            "picture" => "nullable|image|mimes:jpg,jpeg,png|max:2048",
        ],
        [
            "password.min" => "Mật khẩu phải có ít nhất 5 ký tự",
            "picture.image" => "Ảnh không đúng định dạng",
        ]
    );

    $user->name = $request->name;
    $user->email = $user->email;
    $user->username = $request->username ? $request->username : explode('@', $user->email)[0];
    $user->type = $request->type;
    $user->status = $request->status;

    if ($request->status == 'active') {
        if ($user->trashed()) {
            $user->restore(); 
        }
    } else {
        if (!$user->trashed()) {
            $user->delete();
        }
    }

    if ($request->filled("password")) {
        $user->password = Hash::make($request->password);
    } else {
          $user->password =  $user->password;
    }

    if ($request->hasFile("picture")) {
        $path = "images/users/";
        if ($user->picture && file_exists(public_path($path.$user->picture))) {
            unlink(public_path($path.$user->picture));
        }
        $file = $request->file("picture");
        $filename = time() . "_" . $file->getClientOriginalName();
        $file->move(public_path($path), $filename);
        $user->picture = $filename;
    }
    $user->save();
    return response()->json([
        "status" => 1,
        "message" => "Cập nhật tài khoản thành công"
    ]);
}

  

    function categoriesPage (Request $request) {
        $data = [
            "pageTitle" => "Manage categories"
        ];
        return view("back.pages.categories_page",$data);
    }
}
