<?php

namespace App\Models\Ads;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model {
    protected $guarded = [];

    public static function filter(){
        return Ad::with('category')->orderByDesc('id')->paginate();
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function getMainImage($arrImages){
        if($arrImages !== null){
            $imgs = json_decode($arrImages);

            return $imgs[0];
        }

        return asset('imgs/placeholder-small.jpg');
    }

    public function getImages($arrImages){
        if($arrImages !== null){
            $imgs = json_decode($arrImages);
            return $imgs;
        }

        return asset('imgs/placeholder-small.jpg');
    }
}
