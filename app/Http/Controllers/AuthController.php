<?php

namespace App\Http\Controllers;

use App\Helpers\MailTrap;
use App\Models\User;
use App\UserStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
class AuthController extends Controller
{
    function loginForm(Request $request) {
        return view("back.pages.auth.login");
    }

    function registerForm(Request $request) {
        return view("back.pages.auth.register");
    }

    function forgotForm(Request $request) {
        return view("back.pages.auth.forgot");
    }

    function loginHandler(Request $request) {
        // 1. Validate user
        $fieldType = filter_var($request->login_id,FILTER_VALIDATE_EMAIL) ? "email": "username";
        if ($fieldType == "email") {
            $request->validate([
                "login_id" => "required|email|exists:users,email",
                "password" => "required|min:5"
            ],[
                "login_id.required" => "Nhập email hoặc username",
                "login_id.exists" => "Không tìm thấy tài khoản với email này",
                "login_id.email" => "Email không hợp lệ"
            ]);
        }
        else {
            $request->validate([
                "login_id" => "required|exists:users,username",
                "password" => "required|min:5"
            ],[
                "login_id.required" => "Nhập email hoặc username",
                "login_id.exists" => "Không tìm thấy tài khoản với username này"
            ]);
        }

        $user = User::withTrashed()
        ->where($fieldType, $request->login_id)
        ->first();

        if (!$user) {
            return redirect()->route("login")->withInput()->with("fail", "Tài khoản không tồn tại");
        }


        if (!Hash::check($request->password, $user->password)) {
            return redirect()->route("login")->withInput()->with("fail", "Mật khẩu không chính xác");
        }

        if ($user->status == UserStatus::InActive) {
            return redirect()->route("login")->withInput()->with("fail", "Tài khoản của bạn đang bị khóa");
        }

        Auth::login($user);
        if ($user->type == "superAdmin" || $user->type == "admin") {
            return redirect()->route("dashboard");
        }
        return redirect()->route("home");
    }
   function registerHandler(Request $request)
{
    // 1. Validate
    $request->validate([
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|min:5'
    ], [
        'email.required' => 'Email không được để trống',
        'email.email'    => 'Email không hợp lệ',
        'email.unique'   => 'Email đã tồn tại',
        'password.required' => 'Mật khẩu không được để trống',
        'password.min'   => 'Mật khẩu tối thiểu 5 ký tự'
    ]);

    $username = Str::before($request->email, '@');

    $user = User::create([
        'email'    => $request->email,
        'username' => $username,
        'name'     => $username,
        'password' => Hash::make($request->password),
        'status'   => UserStatus::Active,
        'type'     => 'user'
    ]);

    Auth::login($user);

    return redirect()
        ->route('home')
        ->with('success', 'Đăng ký tài khoản thành công. Vui lòng đăng nhập.');
}

    function sendPasswordResetLink(Request $request) {
        // 1. Validate form
        $request->validate([
            "email" => "required|email|exists:users,email"
        ],[
            "email.required"=> "Vui lòng nhập :attribute",
            "email.email" => "Email không hợp lệ",
            "email.exists" => "Không tìm thấy tài khoản với email này"
        ]);
        // 2. Get user detail
        $user = User::where("email",$request->email)->first();
        // 3. Generate token
        $token = base64_encode(Str::random(64));
        // 4. Check if there is an exsitng token
        $oldToken = DB::table("password_reset_tokens")
                    ->where("email",$user->email)
                    ->first();
        if ($oldToken) {
            DB::table("password_reset_tokens")
            ->where("email",$user->email)
            ->update([
                "token" => $token,
                "created_at" => Carbon::now()
            ]);
        } else {
            DB::table("password_reset_tokens")
            ->insert([
                "token" => $token,
                "email" => $user->email,
                "created_at" => Carbon::now()
            ]);
        }
        // 5. Create clickable action link
        $actionLink = route("reset_password_form", ["token" => $token]);
        $data = array(
            "actionLink" => $actionLink,
            "user" => $user
        );
        $mail_body = view("email-templates.forgot-template",$data)->render();
        $mailConfig = array(
            "recipient_address" => $user->email,
            "recipient_name" => $user->name,
            "subject" => "Reset Password",
            "body" => $mail_body
        );
        if (MailTrap::send($mailConfig)) {
            return redirect()->route("forgot")->with("success","Chúng tôi đã gửi link reset password vào email cho bạn");
        } else
            return redirect()->route("forgot")->with("fail","Some thing went wrong. Reset password link not sent. Please try again");
    }

    function resetForm(Request $request,$token = null) {
        $isExistsToken = DB::table("password_reset_tokens")
                        ->where("token",$token)
                        ->first();
        if (!$isExistsToken) 
            return redirect()->route("forgot")->with("fail","Invalid token");
        else {
            $data =  [
                "pageTitle" => "Reset Password",
                "token" => $token
            ];
            return view("back.pages.auth.reset",$data);
        }

    }

    function resetPasswordHandler(Request $request) { 
        $request->validate([
            "new_password" => "required|min:5|required_with:new_password_confirmation|same:new_password_confirmation",
            "new_password_confirmation" => "required"
        ]);
        $dbToken = DB::table("password_reset_tokens")
                    ->where("token", $request->token)
                    ->first();
        $user = User::where("email", $dbToken->email)->first();
        User::where("email",$user->email)->update([
            "password" => Hash::make($request->new_password)
        ]);
        $data = array(
            "user" => $user,
            "new_password" => $request->new_password
        );
        $mail_body = view("email-templates.password-changes-template",$data)->render();
          $mailConfig = array(
            "recipient_address" => $user->email,
            "recipient_name" => $user->name,
            "subject" => "Password Changed",
            "body" => $mail_body
        );
        if (MailTrap::send($mailConfig)) {
            DB::table("password_reset_tokens")
            ->where([
                "token" => $dbToken->token,
                "email" => $dbToken->email
            ])
            ->delete();
            return redirect()->route("login")->with("success","Cập nhật mật khẩu thành công");
        } else {
            return redirect()->route("reset_password_form",["token"=> $dbToken->token])->with("fail","Something went wrong. Please try again");
            }
        }
   
}
