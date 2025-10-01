<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Order extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'orders';

    protected $fillable = [
        'product_name',
        'quantity',
        'customer_name',
        'email',
        'phone',
        'address'
    ];
}
