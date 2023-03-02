<?php

namespace arghavan\User\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use arghavan\User\Mail\ResetPasswordRequestMail;
use arghavan\User\Services\VerifyCodeService;

class ResetPasswordRequestNotification extends Notification
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

        VerifyCodeService::store($notifiable->id,$code,120);

        return (new ResetPasswordRequestMail($code))->to($notifiable->email);
    }


    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
