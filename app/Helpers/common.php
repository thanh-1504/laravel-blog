<?php

use App\Models\Category;
use App\Models\ParentCategory;
use App\Models\Post;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

if (!function_exists("navigations")) {
    function navigations() {
        $navigations_html = "";
        
        // 1. Lấy danh mục Cha (ParentCategory) có danh mục con chứa bài viết
        $pcategories = ParentCategory::whereHas("hasCategories", function($q) {
            $q->whereHas("posts");
        })->orderBy("name", "asc")->get();

        $categories = Category::whereHas("posts")
            ->where("parent", 0)
            ->orderBy("name", "asc")
            ->get();

        foreach ($pcategories as $item) {
            $navigations_html .= '
            <div class="relative group">
                <button class="flex items-center gap-1 hover:text-accent focus:outline-none transition-colors">
                    ' . $item->name . '
                    <svg class="w-4 h-4 mt-[1px]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="absolute left-0 top-full h-4 w-full"></div>
                <div class="absolute top-full left-0 mt-3 w-52 bg-white border border-border rounded-md shadow-lg opacity-0 scale-95 pointer-events-none group-hover:opacity-100 group-hover:scale-100 group-hover:pointer-events-auto transition duration-200 z-50">
                    <ul class="py-2 text-sm text-textMain">';
            
            foreach ($item->hasCategories as $category) {
                if ($category->posts->count() > 0) {
                    $navigations_html .= '<li><a href="'.route("category_posts",$category->slug).'" class="block px-4 py-2 hover:bg-gray-50">' . $category->name . '</a></li>';
                }
            }
            $navigations_html .= '</ul></div></div>';
        }

        foreach ($categories as $item) {
            $navigations_html .= '<a href="'.route("category_posts",$item->slug).'" class="hover:text-accent transition-colors">' . $item->name . '</a>';
        }
        return $navigations_html;
    }

    }

if (!function_exists("date_formatter")) {
    function date_formatter($value, $format = "LL") {
        return $value instanceof Carbon
            ? $value->isoFormat($format)
            : Carbon::parse($value)->isoFormat($format);
    }
}


// if(!function_exists("words")) {
//     function words($value,) {

//     }
// }

if(!function_exists("readDuration")) {
    function readDuration(...$text) {
        Str::macro("timeCounter",function($text) {
            $totalWords = str_word_count(implode(" ",$text));
            $minutesToRead = round($totalWords / 200);
            return (int)max(1,$minutesToRead);
        });
        return Str::timeCounter($text);
    }
}

if(!function_exists("latest_posts")) {
    function latest_posts($skip = 0,$limit = 5) {
            return Post::skip($skip)
                    ->limit($limit)
                    ->where("visibility",1)
                    ->orderBy("created_at","desc")
                    ->get();
        };
}


if(!function_exists("sidebar_categories")) {
    function sidebar_categories($limit = 8) {
            return Category::withCount("posts")
                    ->having("posts_count",">",0)
                    ->limit($limit)
                    ->orderBy("posts_count","desc")
                    ->get();
        };
}

