<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;


class FeaturedProduct extends Model
{
    protected $fillable = [

        'start',
        'end',
        'type',
        'product_id',
        'store_id',
        'number_days'
    ];

    public $name = "";
    public $picture = "";

    public function store(){
        return $this->belongsTo(Store::class,'store_id');
    }

    public function findProduct($id){
        return Product::find($id);
    }



    public function  featured($featured){
        //find the product
        $product = $this->findProduct($featured->product_id);

            $this->name = $product->title;
            $this->picutre = $product->getImage('thumbnail_smaller');
    }
}
