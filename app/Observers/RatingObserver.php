<?php

namespace App\Observers;

use App\Models\Notification;
use App\Models\Rating;
use App\Notifications\AddLike;

class RatingObserver {
    /**
     * Handle the rating "created" event.
     *
     * @param  \App\Models\Rating $rating
     * @return void
     */
    public function created(Rating $rating){
        $post = $rating->post;
        if(auth()->user()->id !== $post->user_id){
            $post->user->notify(new AddLike($rating));

        }
    }

    /**
     * Handle the rating "updated" event.
     *
     * @param  \App\Models\Rating $rating
     * @return void
     */
    public function updated(Rating $rating){
        $user = $rating->post->user;
        Notification::where("notifiable_id", $user->id)->delete();
        if($rating->type >= 0)
            $user->notify(new AddLike($rating));

    }

    /**
     * Handle the rating "deleted" event.
     *
     * @param  \App\Models\Rating $rating
     * @return void
     */
    public function deleted(Rating $rating){
        //
    }

    /**
     * Handle the rating "restored" event.
     *
     * @param  \App\Models\Rating $rating
     * @return void
     */
    public function restored(Rating $rating){
        //
    }

    /**
     * Handle the rating "force deleted" event.
     *
     * @param  \App\Models\Rating $rating
     * @return void
     */
    public function forceDeleted(Rating $rating){
        //
    }
}
