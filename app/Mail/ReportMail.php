<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReportMail extends Mailable
{
    use Queueable, SerializesModels;

       /**
     * Create a new message instance.
     */
    private $infos;
    public function __construct($infos)
    {
        $this->infos = $infos;
       
    }

    public function build(){
        return $this->view("ReportMailPage")->subject("Daily Report Mail")->with("informations", $this->infos);
    }
}
