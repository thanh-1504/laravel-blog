<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ParentCategory;
use App\Models\Post;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    function addPost (Request $request) {
        $categories_html = "";
        $pcategories = ParentCategory::whereHas("hasCategories")->orderBy("name","asc")->get();
        $categories = Category::where("parent",0)->orderBy("name","asc")->get();
        if (count($pcategories) > 0) {
            foreach ($pcategories as $item) { 
                $categories_html .= '<optgroup label="' . $item->name . '">';
                foreach($item->hasCategories as $category) {
                    $categories_html.= '<option value="'.$category->id.'">'.$category->name.'</option>';
                }
                $categories_html.= "</optgroup>";
            }
        }

        if (count($categories) > 0) {
            foreach ($categories as $item) {
                $categories_html.='<option value="'.$item->id.'">'.$item->name.'</option>';
            }
        }
        $data = [
            "categories_html"=> $categories_html
        ];
        return view("back.pages.add_post",$data);
    }

    function createPost(Request $request) {
        $request->validate([
            "title" => "required|unique:posts,title",
            "content" => "required",
            "category" => "required|exists:categories,id",
            "featured_image" => "required|mimes:png,jpg,jpeg|max:1024"
        ]);

        if ($request->hasFile("featured_image")) {
            $path = "images/posts";
            $file = $request->file("featured_image");
            $filename = $file->getClientOriginalName();
            $new_filename = time()."_".$filename;
            $upload = $file->move(public_path($path),$new_filename);
            if ($upload) {
                $post = new Post();
                $post->author_id = auth()->id();
                $post->category = $request->category;
                $post->title = $request->title;
                $post->content = $request->content;
                $post->featured_image = $new_filename;
                $post->tags = $request->tags;
                $post->visibility = $request->visibility;
                $saved = $post->save();
                if ($saved) {
                    return response()->json(["status" => 1,"message" => "Tạo bài viết thành công"]);
                } else {
                    return response()->json(["status" => 0,"message" => "Tạo bài viết thất bại"]);
                }

            } else {
                return response()->json(["status" => 0,"message" => "Có lỗi xảy ra với upload ảnh"]);
            }
        }
        
    }

    function allPosts(Request $request) {
        $data = [
            ""
        ];
        return view("back.pages.posts",$data);
    }

    function editPost(Request $request,$id = null) {
        $post = Post::findOrFail($id);
        $categories_html = "";
        $pcategories = ParentCategory::whereHas("hasCategories")->orderBy("name","asc")->get();
        $categories = Category::where("parent",0)->orderBy("name","asc")->get();
         if (count($pcategories) > 0) {
            foreach ($pcategories as $item) { 
                $categories_html.= '<optgroup label="'.$item->name.'">';
                foreach($item->hasCategories as $category) {
                    $selected = $category->id == $post->category ? "selected" : "";
                    $categories_html.= '<option value="'.$category->id.'" '.$selected.'>'.$category->name.'</option>';
                }
                $categories_html.='</optgroup>';
            }
        }

        if (count($categories) > 0) {
            foreach ($categories as $item) {
                $selected = $item->id == $post->category ? "selected" : "";
                $categories_html.='<option value="'.$item->id.'">'.$item->name.'</option>';
            }
        }

        $data = [
            "post" => $post,
            "categories_html" => $categories_html
        ];
        return view("back.pages.edit_post",$data);
    }

    function updatePost(Request $request) {
        $post = Post::findOrFail($request->post_id);
        $featured_image_name = $post->featured_image;
        $request->validate([
            "title" => "required|unique:posts,title,".$post->id,
            "content" => "required",
            "category" => "required|exists:categories,id",
            "featured_image" => "nullable|mimes:jpeg,png|max:1024"
        ]);
        if ($request->hasFile("featured_image")) {
            $old_featured_image = $post->featured_image;
            $path = "images/posts/";
            $file = $request->file("featured_image");
            $fileName = $file->getClientOriginalName();
            $new_filename = time().'_'.$fileName;
            $upload = $file->move(public_path($path),$new_filename);
            if ($upload) {
              if ($old_featured_image != null && File::exists(public_path($path.$old_featured_image))) {
                File::delete(public_path($path.$old_featured_image));
              }
              $featured_image_name = $new_filename;
            } 
            else {
                return response()->json(["status" => 0, "message" => "Upload hình ảnh fail"]);
            }
        }
        $post->category = $request->category;
        $post->title = $request->title;
        $post->slug = null;
        $post->content = $request->content;
        $post->featured_image = $featured_image_name;
        $post->tags = $request->tags;
        $post->visibility = $request->visibility;
        $saved = $post->save();
        if ($saved) {
            return response()->json(["status" => 1, "message" => "Sửa bài viết thành công"]);
        } else {
             return response()->json(["status" => 0, "message" => "Sửa bài viết thất bại"]);
        }
    }

    public function uploadCkeditorImage(Request $request){
        if ($request->hasFile('upload')) {

            $path = public_path('images/posts');
            $file = $request->file('upload');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move($path, $filename);
            $url = asset('images/posts/'.$filename);
            return response()->json([
                'uploaded' => 1,
                'fileName' => $filename,
                'url'      => $url
            ]);
        }

        return response()->json([
            'uploaded' => 0,
            'error' => ['message' => 'Upload thất bại']
        ]);
    }

}
