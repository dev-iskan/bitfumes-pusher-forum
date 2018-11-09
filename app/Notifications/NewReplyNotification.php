<?php

namespace App\Notifications;

use App\Http\Resources\ReplyResource;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewReplyNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $reply;
    public function __construct($reply)
    {
        $this->reply = $reply;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'replyBy' => $this->reply->user->name,
            'question' => $this->reply->question->title,
            'path' => $this->reply->question->path
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'replyBy' => $this->reply->user->name,
            'question' => $this->reply->question->title,
            'path' => $this->reply->question->path,
            'reply' =>new ReplyResource($this->reply)
        ]);
    }
}
