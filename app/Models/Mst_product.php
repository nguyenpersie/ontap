<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mst_product extends Model
{
    protected $primaryKey = 'product_id';

    use HasFactory;

    protected $table = 'mst_products';

    protected $fillable = [
        'product_id',
        'product_name',
        'product_price',
        'deccription',
        'is_sales',
        'product_image',
    ];
}
