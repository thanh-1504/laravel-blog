<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
       use Sluggable;
    protected $fillable = [
        "author_id",
        "category",
        "title",
        "slug",
        "content",
        "featured_image",
        "tags",
        "visibility",
    ];

      function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    function author() {
        return $this->hasOne(User::class,'id','author_id');
    }

    function post_category() {
        return $this->hasOne(Category::class,'id','category');
    }

    function scopeSearch($query,$term) {
        $term = "%$term%";
        $query->where(function($query) use ($term) {
            $query->where("title","like",$term);
        });
    }
}
