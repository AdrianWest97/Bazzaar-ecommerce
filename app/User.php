<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\SavedProduct;
use App\Http\Traits\Hashidable;
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use Hashidable;

    public $user_notifications = 0;
    public $user_store_notifications = 0;
    public $totalNotifications = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname','lastname', 'supplier', 'email', 'phone', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function stores(){
        return $this->hasOne(Store::class,"user_id");
    }


    public function avatar(){
        return $this->hasOne(Avatar::class,"user_id");
    }

    public function countNotifications(){
        if($this->unReadNotifications->count() > 0){
            $this->user_notifications = $this->unreadnotifications->count();
        }

        if($this->stores!=null){
            if($this->stores->unreadnotifications->count() > 0){
                $this->user_store_notifications = $this->stores->unreadnotifications->count();
            }
        }

      $this->totalNotifications = $this->user_notifications + $this->user_store_notifications;

      return $this->totalNotifications;
    }

}
