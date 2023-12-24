<?php

namespace App\Models;

use App\Models\Poli;
use App\Models\JadwalPeriksa;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Dokter extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'dokter';

    protected $fillable = [
        'nama',
        'password',
    ];


    public function poli(){
        return $this->belongsTo(Poli::class);
    }

    public function jadwal_periksa(){
        return $this->hasMany(JadwalPeriksa::class);
    }

}
