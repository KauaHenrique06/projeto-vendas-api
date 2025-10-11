<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sale extends Model
{
    
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'unit_price',
        'total_price',
    ];

    /**
     * Uma venda pertence a um produto
     * 
     * @return BelongsTo
     */
    public function product(): BelongsTo {

        return $this->belongsTo(Product::class);

    }

    /**
     * Uma venda pertecen a um usuário 
     * 
     * @return BelongsTo
     */
    public function user(): BelongsTo {

        return $this->belongsTo(User::class);

    }
    
}
