<?php

namespace App\Models;

use App\Models\DetailPeriksa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Obat extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'obat';

    public function detail_periksa(){
        return $this->hasMany(DetailPeriksa::class);
    }
}
