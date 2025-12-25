<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //
    function index(Request $request) {
        $data = [

        ];
        return view("front.layout.index",$data);
    }

    function categoryPosts(Request $request,$slug = null) {
        $category = Category::where("slug",$slug)->firstOrFail();
        $posts = Post::where("category",$category->id)
        ->where("visibility","=",1)
        ->paginate(8);
        $data = [
            "category" => $category,
            "posts" => $posts
        ];
        return view("front.pages.category_posts",$data);
    }

    function authorPosts(Request $request,$username = null) {
        $author = User::where("username",$username)->firstOrFail();
        $posts = Post::where("author_id",$author->id)->orderBy("created_at","desc")->get();
        $data = [
            "author" => $author,
            "posts" => $posts
        ];
        return view("front.pages.author_posts",$data);
    }

    function searchPosts(Request $request) {
        $query = $request->input("q");
        if ($query) {
            $keywords = explode(" ",$query);
            $postsQuery = Post::query();
            foreach($keywords as $keyword) {
                $postsQuery->orWhere("title","LIKE","%".$keyword."%")
                            ->orWhere("tags","LIKE","%".$keyword."%");
            }
            $posts = $postsQuery->where("visibility",1)->orderBy("created_at","desc")->get();

        } else {
            $posts = collect();
        }
        $data = [
            "query" => $query,
            "posts" => $posts
        ];
        return view("front.pages.search_posts",$data);
    }

    function readPost(Request $request,$slug = null) {
        $post = Post::where("slug",$slug)->firstOrFail();
        $relatedPosts = Post::where("category",$post->category)
                        ->where("id","!=",$post->id)
                        ->where("visibility",1)
                        ->take(3)
                        ->get();
        $nextPost = Post::where("id",">",$post->id)
                    ->where("visibility",1)
                    ->orderBy("id","asc")
                    ->first();
        $prevPost = Post::where("id","<",$post->id)
                    ->where("visibility",1)
                    ->orderBy("id","desc")
                    ->first();
        $data = [
            "post" => $post,
            "relatedPosts" => $relatedPosts,
            "nextPost" => $nextPost,
            "prevPost" => $prevPost
        ];
        return view("front.pages.single_post",$data);

    }
}
