<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Rating;
use App\Observers\CommentObserver;
use App\Observers\RatingObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider {
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(){
        Schema::defaultStringLength(191);
        Comment::observe(CommentObserver::class);
        Rating::observe(RatingObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(){
        //
    }
}
