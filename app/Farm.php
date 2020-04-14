<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Farm extends Model
{
    protected $fillable = [
        'name',
        'description',
        'vendor',
        'tags',
        'price',
        'location',
        'quantity',
        'weight',
        'type',
        'unit'
    ];

    public function product(){
        return $this->belongsTo(Product::class,"productable_id");
    }
}
