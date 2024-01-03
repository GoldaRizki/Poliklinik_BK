<?php

namespace App\Models;

use App\Models\Periksa;
use App\Models\JadwalPeriksa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DaftarPoli extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'daftar_poli';

    public function periksa(){
        return $this->hasOne(periksa::class);
    }
    public function jadwal_periksa(){
        return $this->belongsTo(JadwalPeriksa::class);
    }

    public function pasien(){
        return $this->belongsTo(Pasien::class);
    }

}
