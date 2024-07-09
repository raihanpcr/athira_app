<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'pesanans';
    protected $guarded = ['id'];

    public function keberangkatan()
    {
        return $this->hasMany(Keberangkatan::class, 'id', 'keberangkatan_id');
    }

    public function pemesan(){
        return $this->hasMany(User::class, 'id', 'user_id');
    }
}
