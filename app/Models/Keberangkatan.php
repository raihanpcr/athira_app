<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keberangkatan extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'keberangkatan';
    protected $guarded = ['id'];

    public function scopeFilter($query, array $filter){
        return $query->when($filter['tanggal'] ?? false, function ($q, $tanggal){
            
        });
    }

    public function mobils(){
        return $this->belongsTo(Mobil::class, 'mobil_id', 'id');
    }

    public function asals(){
        return $this->belongsTo(Estimasi::class, 'asal', 'id');
    }

    public function tujuans(){
        return $this->belongsTo(Estimasi::class, 'tujuan', 'id');
    }

    public function supirs(){
        return $this->belongsTo(Supir::class, 'supir_id', 'id');
    }

    public function pesanan(){
        return $this->hasMany(Pesanan::class, 'keberangkatan_id', 'id');
    }
}
