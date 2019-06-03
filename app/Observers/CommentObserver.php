<?php

namespace App\Observers;

use App\Models\Comment;
use App\Models\Notification;
use App\Notifications\{AddComment, ReplyComment};
use App\Models\Post;
use Illuminate\Support\Facades\Log;

class CommentObserver {
    /**
     * Handle the comment "created" event.
     *
     * @param  \App\Models\Comment $comment
     * @return void
     */
    public function created(Comment $comment){

        if($comment->user_id_reply === null){ // Кто-то прокомментил пост
            $this->sendNotif($comment->post->user, new AddComment($comment), auth()->user()->id);
        } else {
            $user = $comment->user;
            $userPost = $comment->post->user;
            $userReply = $comment->userReply;
            if($user->id !== $userReply->id){ // Если он не ответил себе
                if($userPost->id !== $userReply->id){
                    $userPost->notify(new AddComment($comment));
                }
                $userReply->notify(new ReplyComment($comment));
            } else {
                if($userReply->id !== $comment->user_id_reply)
                    $userReply->notify(new ReplyComment($comment));
            }

        }

    }

    /**
     * Handle the comment "updated" event.
     *
     * @param  \App\Models\Comment $comment
     * @return void
     */
    public function updated(Comment $comment){
        //
    }

    /**
     * Handle the comment "deleted" event.
     *
     * @param  \App\Models\Comment $comment
     * @return void
     */
    public function deleted(Comment $comment){
        Notification::where([['notifiable_type', "App\Models\Comment"], ['notifiable_id', $comment->id]])->delete();
    }

    /**
     * Handle the comment "restored" event.
     *
     * @param  \App\Models\Comment $comment
     * @return void
     */
    public function restored(Comment $comment){
        //
    }

    /**
     * Handle the comment "force deleted" event.
     *
     * @param  \App\Models\Comment $comment
     * @return void
     */
    public function forceDeleted(Comment $comment){
        //
    }

    public function sendNotif($user, $notif, $userID) {
        if($userID !== $user->id) {
            $user->notify($notif);
        }
    }
}
