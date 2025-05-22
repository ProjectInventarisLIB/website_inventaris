<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPengambilan extends Model
{
    protected $table = 'surat_pengambilan';
    use HasFactory;
        protected $guarded = [
        'id',
    ];

    public function details()
    {
        return $this->hasMany(DetailSuratPengambilan::class, 'ID_pengambilan', 'ID_pengambilan');
    }
}
