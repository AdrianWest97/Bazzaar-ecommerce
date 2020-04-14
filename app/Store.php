<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'name',
        'owner',
        'description',
        'location',
        'type',
        'logo',
        'header',
        'email',
        'password',
        'tags'
    ];

    public function products(){
      return  $this->hasMany(Product::class,"store_id");
    }

    public function supplier(){
       return $this->belongsTo(User::class,"user_id");
    }

    public function address(){
      return $this->morphOne(Address::class,"addressable");
    }

    
    //get or add a new featured product
    public function featuredProducts(){
      return $this->hasMany(FeaturedProduct::class,'store_id');
  }
}
