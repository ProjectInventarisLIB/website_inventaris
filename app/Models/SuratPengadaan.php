<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPengadaan extends Model
{
    protected $table = 'surat_pengadaan';
    use HasFactory;
        protected $guarded = [
        'id',
    ];

    public function details()
    {
        return $this->hasMany(DetailSuratPengadaan::class, 'ID_pengadaan', 'ID_pengadaan');
    }

    public function staf()
{
    return $this->belongsTo(User::class, 'ID_Staf', 'id');
}
}
