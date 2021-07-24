<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use Searchable;

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

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        unset($array['image_url']);

        return $array;
    }
}
