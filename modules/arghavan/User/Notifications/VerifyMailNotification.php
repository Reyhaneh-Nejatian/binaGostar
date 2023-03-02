<?php

namespace arghavan\User\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use arghavan\User\Mail\VerifyCodeMail;
use arghavan\User\Services\VerifyCodeService;

class VerifyMailNotification extends Notification
{
    use Queueable;


    public function __construct()
    {
        //
    }


    public function via($notifiable)
    {
        return ['mail'];
    }


    public function toMail($notifiable)
    {

        $code = VerifyCodeService::generate();

       VerifyCodeService::store($notifiable->id,$code,now()->addDay());

        return (new VerifyCodeMail($code))->to($notifiable->email);
    }


    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
