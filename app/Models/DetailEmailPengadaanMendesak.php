<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailEmailPengadaanMendesak extends Model
{
    protected $table = 'detail_email_pengadaan_mendesak';
    use HasFactory;
        protected $guarded = [
        'id',
    ];

    public function email()
    {
        return $this->belongsTo(EmailPengadaanMendesak::class, 'ID_pengadaan_mendesak', 'ID_pengadaan_mendesak');
    }
}
