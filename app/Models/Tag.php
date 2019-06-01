<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['title'];

    public static function add($tags) {
        $successTags = [];

        foreach($tags as $tag) {
            $successTags[] = self::firstOrCreate([
                'title' => $tag
            ])->id;
        }

        return $successTags;
    }
}
