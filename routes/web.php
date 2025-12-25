<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/",[BlogController::class,"index"])->name("home");


Route::post('/ckeditor/upload', [PostController::class, 'uploadCkeditorImage'])
    ->name('ckeditor.upload');



 Route::middleware(["auth","prevent-back-history"])->group(function() {
        Route::controller(AdminController::class)->group(function() {
            Route::get("/dashboard","adminDashboard")->name("dashboard");
            Route::get("/users","getadminGetUsersView")->name("users");
            Route::post("/user/create","createUser")->name("create_user");
             Route::get("/user/{id}/edit","editUser")->name("edit_user");
            Route::post("/user/update","updateUser")->name("update_user");
            Route::get("/user/new","addUser")->name("add_user");
            Route::post("/logout","logoutHandle")->name("logout");
            Route::get("/profile","profileView")->name("profile");
            Route::middleware(["OnlySuperAdmin"])->group(function() {
                Route::get("/categories","categoriesPage")->name("categories");
            });
        });


   Route::controller(PostController::class)->group( function() {
    Route::get("/post/new","addPost")->name("add_post");
    Route::post("/post/create","createPost")->name("create_post");
    Route::get("/posts","allPosts")->name("posts");
    Route::get("/post/{id}/edit","editPost")->name("edit_post");
    Route::post("/post/update","updatePost")->name("update_post");
   });

});

Route::get("/post/{slug}",[BlogController::class,"readPost"])->name("read_post");
Route::get("/posts/category/{slug}",[BlogController::class,"categoryPosts"])->name("category_posts");
Route::get("/posts/author/{username}",[BlogController::class,"authorPosts"])->name("author_posts");
Route::get("/posts/tag/{any}",[BlogController::class,"tagPosts"])->name("tag_posts");
Route::get("/search",[BlogController::class,"searchPosts"])->name("search_posts");


 Route::middleware(["guest","prevent-back-history"])->group(function() {
        Route::controller(AuthController::class)->group(function() {
            Route::get("/register","registerForm")->name("register");
            Route::post("/register","registerHandler")->name("register_handler");
            Route::get("/login","loginForm")->name("login");
            Route::post("/login","loginHandler")->name("login_handler");
            Route::get("/forgot-password","forgotForm")->name("forgot");
            Route::post("/send-password-reset-link","sendPasswordResetLink")->name("send_password_reset_link");
            Route::get("/password/reset/{token}","resetForm")->name("reset_password_form");
            Route::post("reset-password-handler","resetPasswordHandler")->name("reset_password_handler");
        });
    });
