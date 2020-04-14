<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\store;
use App\Review;

class Product extends Model
{

    protected $fillable = [
        'type',
        'title',
        'vendor',
        'description',
        'location',
        'available',
        'price',
        'quantity',
        'tags',
        'weight',
        'unit',
        'make',
        'model',
        'year',
        'transmission',
        'features',
        'brand',   

    ];



    public function store(){
        return $this->belongsTo(Store::class,'store_id');
    }

    public function images(){
        return $this->hasMany(Image::class,"product_id");
    }


    public function getImage($path){
        return asset('products/'.$path.'/'.$this->images->first()->image);
    }

    public function get_small_image($img,$path){
        return asset('products/'.$path.'/'.$img);

    }

    public function similar($type){
        return Product::where('type',$type)->get()->except('id',$this->id);
    }

    public function reviews(){
        return $this->hasMany(Review::class,'product_id');
    }

    
}
