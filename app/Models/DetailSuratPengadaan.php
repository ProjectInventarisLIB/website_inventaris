<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSuratPengadaan extends Model
{
    protected $table = 'detail_surat_pengadaan';
    use HasFactory;
        protected $guarded = [
        'id',
    ];

    public function surat()
    {
        return $this->belongsTo(SuratPengadaan::class, 'ID_pengadaan', 'ID_pengadaan');
    }
}
