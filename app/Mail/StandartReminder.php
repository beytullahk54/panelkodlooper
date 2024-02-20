<?php

namespace App\Mail;

use Config;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class StandartReminder extends Mailable
{
    use Queueable, SerializesModels;
    public $email,$mesaj,$baslik;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email,$mesaj,$baslik)
    {


        $this->email=$email;
        $this->mesaj=$mesaj;
        $this->baslik=$baslik;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject( $this->baslik);
        return $this->view('mail.standartReminder');
    }
}
