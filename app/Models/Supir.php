<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supir extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'supir';
    protected $guarded = ['id'];

    public function keberangkatan()
    {
        return $this->hasMany(Keberangkatan::class, 'id', 'supir_id');
    }
}
