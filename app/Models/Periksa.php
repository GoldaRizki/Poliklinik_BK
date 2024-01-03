<?php

namespace App\Models;

use App\Models\DaftarPoli;
use App\Models\DetailPeriksa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Periksa extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'periksa';



    public function detail_periksa(){
        return $this->hasMany(DetailPeriksa::class);
    }

    public function daftar_poli(){
        return $this->belongsTo(DaftarPoli::class);
    }



}
