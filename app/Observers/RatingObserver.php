<?php

namespace App\Observers;

use App\Models\Notification;
use App\Models\Rating;
use App\Notifications\AddLike;
use Illuminate\Support\Facades\Log;

class RatingObserver {
    /**
     * Handle the rating "created" event.
     *
     * @param  \App\Models\Rating $rating
     * @return void
     */
    public function created(Rating $rating){
        //        $post = $rating->post;
        $user = Rating::withModel($rating);
        if(auth()->user()->id != $user->user_id){
            $user->user->notify(new AddLike($rating));

        }
    }

    /**
     * Handle the rating "updated" event.
     *
     * @param  \App\Models\Rating $rating
     * @return void
     */
    public function updated(Rating $rating){
        $user = Rating::withModel($rating);
        Notification::where("notifiable_id", $user->id)->delete();
        
        if($rating->type >= 0 && auth()->user()->id != $user->user_id)
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
