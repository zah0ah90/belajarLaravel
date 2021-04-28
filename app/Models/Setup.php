<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setup extends Model
{
    protected $table = 'setup_aplikasi';
    protected $fillable = ['nama_aplikasi', 'jumlah_hari_kerja'];
}