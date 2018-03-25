<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'id',
        'name',
        'description',
        'purchase_price',
        'sale_price',
        'current_stock',
        'image',
    ];
}
