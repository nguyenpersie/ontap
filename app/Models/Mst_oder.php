<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mst_oder extends Model
{
    use HasFactory;

    protected $table = 'mst_oders';

    protected $fillable = [
        'order_id',
        'order_shop',
        'customer_id',
        'totle_price',
        'payment_method',
        'ship_charge',
        'tax',
        'order_date',
        'shipment_date',
        'cancel_date',
        'order_status',
        'note_customer',
        'error_code_api',

    ];
}
