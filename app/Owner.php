<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;
    
        /**
         * Get the imovel that owns the Owner
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function imovels(): BelongsTo
        {
            return $this->belongsTo(Imovel::class, 'imovel_id', 'id');
        }
    
}
