<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    protected $fillable = [
        'user_id',
        'image'
    ];
    public function user(){
        return $this->belongsTo(User::class,"user_id");
    }
}
