<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mst_customer extends Model
{
    protected $primaryKey = 'customer_id';

    use HasFactory;
    protected $table = 'mst_customers';

    protected $fillable = [
        'customer_id',
        'customer_name',
        'email',
        'tel_num',
        'address',
        'is_active',
    ];
}
