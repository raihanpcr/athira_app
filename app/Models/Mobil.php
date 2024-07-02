<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'mobil';
    protected $guarded = ['id'];

    public function keberangkatan()
    {
        return $this->hasMany(Keberangkatan::class, 'id', 'mobil_id');
    }
}
