<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mst_shop extends Model
{
    use HasFactory;

    protected $table = 'mst_shop';

    protected $filltable = [
        'shop_id',
        'shop_name',
    ];
}
