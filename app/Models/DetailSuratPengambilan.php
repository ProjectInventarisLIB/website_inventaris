<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSuratPengambilan extends Model
{
    protected $table = 'detail_surat_pengambilan';
    use HasFactory;
        protected $guarded = [
        'id',
    ];

    public function surat()
    {
        return $this->belongsTo(SuratPengambilan::class, 'ID_pengambilan', 'ID_pengambilan');
    }
}
