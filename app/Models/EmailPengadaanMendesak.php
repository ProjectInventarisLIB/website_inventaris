<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailPengadaanMendesak extends Model
{
    protected $table = 'email_pengadaan_mendesak';
    use HasFactory;
        protected $guarded = [
        'id',
    ];

    public function details()
    {
        return $this->hasMany(DetailEmailPengadaanMendesak::class, 'ID_pengadaan_mendesak', 'ID_pengadaan_mendesak');
    }
}
