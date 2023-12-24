<?php

namespace App\Models;

use App\Models\Dokter;
use App\Models\DaftarPoli;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JadwalPeriksa extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'jadwal_periksa';


    public function dokter(){
        return $this->belongsTo(Dokter::class);
    }

    public function daftar_poli(){
        return $this->hasMany(DaftarPoli::class);
    }


    
}
