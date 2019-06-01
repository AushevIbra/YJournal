<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TagAndPostRelation extends Model
{
    protected $guarded = [];

    /**
     * @param $tagsIds
     * @param $postID
     *
     * @return
     */
    public static function add($tagsIds, $postID) {
        foreach($tagsIds as $tagsId) {
            self::create([
               'post_id' => $postID,
               'tag_id' => $tagsId
            ]);
        }
    }

    public function tag() {
        return $this->belongsTo(Tag::class);
    }

    public function post() {
        return $this->belongsTo(Post::class);
    }
}
