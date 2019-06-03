<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model {
    protected $guarded = [];
    use Sluggable, SoftDeletes;
    protected $data;
    protected $perPage = 5;

    public function sluggable(){
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    /**
     * Получает записи объединенные с user
     *
     * @return array
     */
    public static function getData($type){
        $data = self::with(['user'])
            ->withCount("countComments")
            ->when(request('user'), function($query){
                return $query->where('user_id', request('user'));
            })
            ->when(request('tag'), function($query){
                return $query->where('user_id', request('user'));
            })
            ->when($type == 'new', function($query){
                return $query->orderByDesc('created_at');
            })
            ->when($type == 'popular', function($query){
                return $query->orderByDesc('views');
            })
            ->when($type == 'all', function($query){
                return $query->orderBy('id', 'asc');
            });
        $data = $data->paginate(5);

        return $data;
    }

    public function findPost($slugString){
        $data = Post::with(['user'])->withCount("countComments")->where('slug', $slugString)->first();

        return $data;
    }

    /**
     * Все комментарии
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    /**
     * Кол-во комментов
     *
     *
     */
    public function countComments(){
        return $this->hasOne(Comment::class);
    }

    /**
     * Объединение с пользователем
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tags(){
        return $this->hasMany(TagAndPostRelation::class);
    }
}
