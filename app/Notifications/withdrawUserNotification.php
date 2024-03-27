<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class withdrawUserNotification extends Notification
{
    use Queueable;
    public $user;
    public $post;
    /**
     * Create a new notification instance.
     */
    public function __construct($user ,$post)
    {
        $this->user = $user;
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                ->line(''.$notifiable->name . '' . $this->post['title'])
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
            'invoice_id' => $this->id,
            'name' => $notifiable->name,
            'amountTransaction' => $notifiable->amountTransaction,
            'dateTransaction' => $notifiable->dateTransaction,
            'receiverName' => $notifiable->receiverName,
            'refTransaction' => $notifiable->refTransaction,
            'statue' => $notifiable->statue,
        ];
    }
}
