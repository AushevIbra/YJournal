<?php

namespace App\Models\Ads;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ad extends Model {
    protected $guarded = [];

    public static function filter(){
        $filter = request()->all('catId', 'childId');
        return Ad::ads($filter['catId'], $filter['childId'])->orderByDesc('ads.id')->paginate(10);
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

    public static function ads($categoryID = null, $childId = null) {
        return DB::table('categories')
            ->select('ads.*', 'categories.name as cat_name')
            ->rightJoin('ads', 'categories.id', '=', 'ads.category_id')
            ->when($categoryID, function($query, $categoryID){
                return $query->where('categories.parent_id', $categoryID);
            })
            ->when($childId, function($query, $childId) {
                return $query->where('categories.id', $childId);
            });
    }
}
