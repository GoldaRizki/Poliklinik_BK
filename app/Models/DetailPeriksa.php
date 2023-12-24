<?php

namespace App\Models;

use App\Models\Obat;
use App\Models\Periksa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailPeriksa extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'detail_periksa';

    public function periksa(){
        return $this->belongsTo(Periksa::class);
    }

    public function obat(){
        return $this->belongsTo(Obat::class);
    }
}
