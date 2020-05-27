<?php

namespace App;

use App\Notifications\productRequest;
use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\Support\Period;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Http\Traits\Hashidable;



use Carbon\Carbon;

class Store extends Authenticatable implements Viewable
{


  use Notifiable;
  use InteractsWithViews;
  use Hashidable;


  protected $guard = 'store';


    protected $fillable = [
        'name',
        'owner',
        'description',
        'type',
        'logo',
        'header',
        'email',
        'password',
        'tags',
        'phone'
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

  public function getViewsForPastdays($period){
    // $date = \Carbon\Carbon::today()->subDays(30);
    return views($this)
    ->period(Period::since(Carbon::create("$period days ago")))
    ->unique()
    ->count();
  }




  public function pastDateViewsChart($period){
    $days = array();
    $view_count = array();
    foreach($this->views as $v){
      //get views for each day
      if($v->viewed_at >= Carbon::create("$period days ago")){
      array_push($days, Carbon::parse($v->viewed_at)->format('M d, yy'));
      
    }
  }
  sort($days);

    
      foreach($days as $d){
      $startDateTime = Carbon::createFromDate($d);
      $endDateTime = next($days);

    
      $count = views($this)->period(Period::create($startDateTime, $endDateTime))
      ->unique()
      ->count();
      if($count > 0){
      array_push($view_count,$count);
      }
      }

      
       unset($days);
       $days = array();
       foreach($this->views as $v){
        //get views for the past 28 days
        if($v->viewed_at >= Carbon::create("$period days ago")){
          if(!in_array(Carbon::parse($v->viewed_at)->format('M d, yy'),$days,true))
        array_push($days, Carbon::parse($v->viewed_at)->format('M d, yy'));
        }
      }

      $max_no = max($view_count);
      $max = round(($max_no + 10/2)/10)*10;
      $chart = array(
        'days' =>$days,
        'views'=>$view_count,
        'max'=>$max
      );
      
    return $chart;
  }

  
    //public top products order by view
    public function topProducts(){
      return $this->products()->orderByUniqueViews()->get();
}

//product reviews count
public function reviewsCount(){
$count = 0;
  foreach($this->products as $product){
    if($product->reviews != null){
      $count += $product->reviews->count();
    }
  }
  return $count;

}

public function productRequestNotification(){
  
   return $this->unreadNotifications();

}

}