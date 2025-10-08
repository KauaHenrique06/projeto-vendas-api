<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    /**
     * Um produto pertece a varias vendas
     * 
     * @return HasMany
     */
    public function sale() {

        return $this->hasMany(Sale::class);

    }
    protected $fillable = [
        'name',
        'price',
        'quantity'
    ];
}
