<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'review',
        'username',
        'email',
        'product_id',
        'rating'
    ];

    public function product(){
        $this->belongsTo(Product::class,'product_id');
    }

}
