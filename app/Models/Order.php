<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'product_name',
        'unit_price',
        'quantity',
        'subtotal',
    ];
}
