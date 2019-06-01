<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Cviebrock\EloquentSluggable\Sluggable;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    protected $guarded = [];
    use Sluggable, SoftDeletes;
    protected $data;
    protected $perPage = 5;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    public function __construct($data = null)
    {
        $this->data = $data;
    }

    public function add()
    {
        $title = $this->data['title'];
        $data = json_encode($this->data['data']);
        $slug = SlugService::createSlug(Post::class, 'slug', $title, ['unique' => true]);
        $this->title = $title;
        $this->body = $data;
        $this->user_id = Auth::user()->id;
        $this->main_img = $this->data['img'];
        $this->slug = $slug;
        $this->save();

        return ['slug' => $this->slug, 'id' => $this->id];
    }

    /**
     * Получает записи объединенные с user
     *
     * @return array
     */
    public static function getData($type)
    {
        $data = self::with(['user'])
            ->withCount("countComments")
            ->when(request('user'), function($query){
              return $query->where('user_id', request('user'));
            })
            ->when(request('tag'), function($query){
              return $query->where('user_id', request('user'));
            })
            ->when($type == 'new', function ($query) {
                return $query->orderByDesc('created_at');
            })
            ->when($type == 'popular', function ($query){
                return $query->orderByDesc('views');
            })
            ->when($type == 'all', function ($query){
                return $query->orderBy('id', 'asc');
            });
        $data = $data->paginate(5);
        return $data;
    }

    public function findPost($slugString)
    {
        $data = Post::with(['user'])->withCount("countComments")->where('slug', $slugString)->first();

        return $data;
    }

    /**
     * Все комментарии
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Кол-во комментов
     *
     *
     */
    public function countComments()
    {
        return $this->hasOne(Comment::class);
    }

    /**
     * Объединение с пользователем
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags() {
        return $this->hasMany(TagAndPostRelation::class);
    }
}
