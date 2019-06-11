<?php

namespace App\Notifications;

use App\Models\Rating;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AddLike extends Notification {
    use Queueable;
    /**
     * @var Rating
     */
    private $rating;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Rating $rating){

        $this->rating = $rating;
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
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    //    public function toMail($notifiable)
    //    {
    //        return (new MailMessage)
    //                    ->line('The introduction to the notification.')
    //                    ->action('Notification Action', url('/'))
    //                    ->line('Thank you for using our application!');
    //    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable){
        $user = $this->rating->user;
        $post = $this->rating->post;
        return [
            'message' => 'Пользователь ' . $user->name . ' оценил Ваш пост',
            'user'    => $user,
            'post'    => $post,
            'href'    => "/post/{$post->slug}",
            'cssClass'    => ($this->rating->type == 1)? "notif-like": "notif-disslike",
            'user_id' => $user->id,
            'post_id' => $post->id,
        ];
    }
}
