<?php

namespace App\BuyerNotifications;

use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Notifications\Messages\MailMessage;

class BuyerPasswordResetNotification extends ResetPasswordNotification
{


    use ResetsPasswords;

    public $token;
    protected $title = 'パスワードリセットのご通知';

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
      $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
          ->subject($this->title)
          ->view(
            'mails.passwordreset',
            [
              'reset_url' => url('buyers/password/reset', $this->token),
            ]);
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
            //
        ];
    }






}