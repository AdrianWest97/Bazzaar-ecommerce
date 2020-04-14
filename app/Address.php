<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
      'country',
      'parish',
      'street',
    ];
    public function addressable(){
        return $this->morphTo();
    }
}
