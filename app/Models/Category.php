<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    //
        use Sluggable;

     protected $fillable = [
        "name",
        "slug",
        "parent",
    ];

    function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    function parent_category() {
        return $this->belongsTo(ParentCategory::class,"parent","id");
    }

    function posts() {
        return $this->hasMany(Post::class,"category","id");
    }
}
