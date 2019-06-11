<?php

namespace App\Notifications;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ReplyComment extends Notification {
    use Queueable;
    /**
     * @var Comment
     */
    private $comment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Comment $comment){
        //
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable){
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable){
        $post = $this->comment->post;
        $user = $this->comment->user;

        return [
            'message'  => 'Пользователь ' . $user->name . ' ответил на Ваш комментарий',
            'user'     => $user,
            'post'     => $post,
            'cssClass' => 'notif-reply-comment',
            'user_id'  => $user->id,
            'post_id'  => $post->id,
            'href'     => "/post/{$post->slug}#{$this->comment->id}",
        ];
    }
}
