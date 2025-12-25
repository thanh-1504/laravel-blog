<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\ParentCategory;
use App\Models\Post;
use Illuminate\Support\Facades\File;
use Livewire\Component;

class Posts extends Component
{
    public $categories_html;
    public $search = null;
    public $author = null;
    public $category = null;
    public $visibility = null;
    public $post_visibility;
    public $sortBy = "asc";

    protected $listeners = [
        "deletePostAction"
    ];

    protected $queryString = [
        "search" => ["except" => ""],
        "author" => ["except" => ""],
        "visibility" => ["except" => ""],
        "sortBy" => ["except" => ""]
    ];

    public function updatedVisibility() {
        $this->post_visibility = $this->visibility == "public" ? 1 : 0;
    }




   
    function mount() {
        $this->author = auth()->user()->type == "superAdmin" ? auth()->user()->id : 0;
        $this->post_visibility = $this->post_visibility == "public" ? 0 : 1;
        $categories_html = "";
        $pcategories = ParentCategory::whereHas("hasCategories",function($q) {
            $q->whereHas("posts");
        })->orderBy("name","asc")->get();
        $categories = Category::whereHas("posts")->where("parent",0)->orderBy("name","asc")->get();
        if (count($pcategories) > 0) {
            foreach($pcategories as $item) {
                $categories_html.='<optgroup label="'.$item->name.'">';
                    foreach($item->hasCategories as $category) {
                        if ($category->posts->count() > 0) {
                            $categories_html.='<option value="'.$category->id.'">'.$category->name.'</option>';
                        }
                    }
                $categories_html.='</optgroup>';
            }
        }
        if (count($categories) > 0) {
            foreach($categories as $item) {
                $categories_html.='<option value="'.$item->id.'">'.$item->name.'</option>';
            }
        }
        $this->categories_html = $categories_html;
    }

    function deletePost($id) {
        $this->dispatch("deletePost",["id" => $id]);
    }

    function deletePostAction($id) {
        $post = Post::findOrFail($id);
        $path = "images/posts/";
        $old_featured_image = $post->featured_image;
        if ($old_featured_image != null && File::exists(public_path($path.$old_featured_image))) {
            File::delete(public_path($path.$old_featured_image));
        }
        $deleted = $post->delete();
        if ($deleted) {
             $this->dispatch("showToastr", type: "success", message: "Xóa bài viết thành công");
        } else {
            $this->dispatch("showToastr", [
            "type" => "error",
            "message" => "Xóa bài viết thất bại"
            ]);
        }

    }
    public function render()
    {
        return view('livewire.admin.posts',[
            "posts" => auth()->user()->type == "superAdmin" ?
             Post::search(trim($this->search))
             ->when($this->author,function($query) {
                $query->where("author_id",$this->author);
             })
             ->when($this->category,function($query) {
                $query->where("category",$this->category);
             })
             ->when($this->visibility,function($query) {
                $query->where("visibility",$this->post_visibility);
             })
              ->when($this->sortBy,function($query) {
                $query->orderBy("id",$this->sortBy);
             })
             ->get() 
            : Post::search(trim($this->search))
            ->when($this->author,function($query) {
                $query->where("author_id",$this->author);
             })
              ->when($this->category,function($query) {
                $query->where("category",$this->category);
             })
               ->when($this->visibility,function($query) {
                $query->where("visibility",$this->post_visibility);
             })
             ->when($this->sortBy,function($query) {
                $query->orderBy("id",$this->sortBy);
             })
            ->where("author_id",auth()->id())
            ->get()
        ]);
    }
}
