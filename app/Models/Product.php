<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'barcode',
        'brand',
        'price',
        'image_url',
        'date_added',
    ];

    protected $casts = [
        'date_added' => 'datetime',
    ];
}
