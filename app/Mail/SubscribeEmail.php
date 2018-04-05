<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubscribeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subs; // получить подписчика  
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subscriber) //класс отвеч за отпр-ку email
    {
        $this->subs = $subscriber;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() 
    {
        return $this->view('emails.verify'); // генерируем новый вид
    }
}
