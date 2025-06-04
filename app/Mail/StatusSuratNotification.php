<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StatusSuratNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $noSurat;
    public $status;

    public function __construct($noSurat, $status)
    {
        $this->noSurat = $noSurat;
        $this->status = $status;
    }

    public function build()
    {
        return $this->subject('Pemberitahuan Status Surat Pengadaan')
                    ->view('staf.details.email_status');
    }
}
