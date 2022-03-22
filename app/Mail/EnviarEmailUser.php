<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnviarEmailUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     public $nomeAnunciante;
    public function __construct($nomeAnunciante)
    {
        $this->$nomeAnunciante = $nomeAnunciante;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject( subject: "Novo imóvel cadastrado");
        return $this->view('email.TemplateEmail');
    }
}
