<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class ParentCategory extends Model
{
        use Sluggable;

    protected $fillable = [
        "name",
        "slug",
    ];

    function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    function hasCategories() {
        return $this->hasMany(Category::class,"parent","id");
    }

}
