<?php

namespace App\Models\Ads;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model {
    use SoftDeletes;
    use Sluggable;
    protected $guarded = [];

    public function sluggable(){
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    public function children() {
        return $this->hasMany(Category::class, 'parent_id')->withCount('ads');
    }

    public function parent() {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }

    public function ads() {
        return $this->hasMany(Ad::class);
    }
}
