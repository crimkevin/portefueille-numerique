<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class transfertUserNotification extends Notification
{
    use Queueable;
    public $sender_post;
    public $receiver_post;
    public $sender;
    public $receiver;

    /**
     * Create a new notification instance.
     */
    public function __construct($sender_post, $receiver_post, $sender, $receiver)
    {
        // $this->sender = $sender;
        // $this->sender_post = $sender_post;

        // $this->receiver_post = $receiver_post;

        // $this->receiver = $receiver;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->line(''.$notifiable->name . ''. $this->sender_post['title'])
        ->line(''.$notifiable->name . ''. $this->receiver_post['title'])
        ->line('You can carry out other operations in total security!')
        ->line('Thank you for your total trust!')
        ->action('Notification Action', url('/'))
        ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            
        ];
    }
}
