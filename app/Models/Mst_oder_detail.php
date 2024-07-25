<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mst_oder_detail extends Model
{
    use HasFactory;

    protected $table = 'mst_oder_details';

    protected $fillable = [
        'order_id',
        'detail_line',
        'product_id',
        'price_buy',
        'quantity',
        'shop_id',
        'receiver_id',

    ];
}
