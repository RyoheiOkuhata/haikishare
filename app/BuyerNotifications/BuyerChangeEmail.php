<?php

namespace App\BuyerNotifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class BuyerChangeEmail extends Notification
{
    use Queueable;
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('メールアドレス変更のご通知') // 件名
            ->view('mails.changeEmail') // メールテンプレートの指定
            ->action(
                'メールアドレス変更',
                url('buyers/emailUpdate/', $this->token) //アクセスするURL
            );
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
