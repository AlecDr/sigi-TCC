<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeImovel extends Model
{
    protected $fillable = ['imovel_type'];

    public function imovels()
    {
        return $this->hasMany(Imovel::class);
    }

}
