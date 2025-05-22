<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PengadaanMendesakMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pengadaan;
    public $items;

    public function __construct($pengadaan, $items)
    {
        $this->pengadaan = $pengadaan;
        $this->items = $items;
    }

    public function build()
    {
        $email = $this->subject('Pengajuan Pengadaan Mendesak')
                      ->view('staf.emails.email_pengadaan_mendesak');

        if ($this->pengadaan->lampiran) {
            $folder = 'foto_pengadaan_mendesak/PENGADAAN' . $this->pengadaan->ID_pengadaan_mendesak;
            $lampiranFiles = json_decode($this->pengadaan->lampiran, true);

            foreach ($lampiranFiles as $filename) {
                $filePath = storage_path("app/public/{$folder}/{$filename}");
                if (file_exists($filePath)) {
                    $email->attach($filePath);
                }
            }
        }

        return $email;
    }
}
