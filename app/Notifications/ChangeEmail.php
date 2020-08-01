<?php
namespace App\Notifications; 

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Notification; 
use Illuminate\Notifications\Messages\MailMessage; 

class ChangeEmail extends Notification 
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
                url('users/reset', $this->token) //アクセスするURL
            );
    }
}
