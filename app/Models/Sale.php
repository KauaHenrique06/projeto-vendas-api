<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    
    /**
     * Uma venda pertence a um produto
     * 
     * @return BelongsTo
     */
    public function product() {

        return $this->belongsTo(Product::class);

    }

    /**
     * Uma venda pertecen a um usuário 
     * 
     * @return BelongsTo
     */
    public function user() {

        return $this->belongsTo(User::class);

    }
    
}
