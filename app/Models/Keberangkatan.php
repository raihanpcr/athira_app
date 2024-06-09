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
}
