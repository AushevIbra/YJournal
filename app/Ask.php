<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ask extends Model {
    protected $guarded = [];

    /**
     * Получает записи объединенные с user
     *
     * @return array
     */
    public static function getData($type = "new"){
        $data = self::with(['user'])
            ->withCount("countAnswers")
            ->when(request('user'), function($query){
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

    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * Кол-во комментов
     *
     *
     */
    public function countAnswers(){
        return $this->hasMany(Answer::class);
    }
}
