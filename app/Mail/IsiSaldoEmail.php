<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class IsiSaldoEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $isisaldo;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($isisaldo)
    {
        $this->isisaldo = $isisaldo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.isisaldoemail');
    }
}
