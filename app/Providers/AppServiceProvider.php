<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Blade;
use Session;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('featured',function($product){
            return $product->featured;
        });

        Blade::if('incart',function($id){
            $cart = Session::has('cart') ? Session::get('cart') : null;
            return array_key_exists($id,$cart->items);
        });

        //currency format
        Blade::directive('convert', function ($amount) {
            return "<?php echo '$'.number_format($amount,2) ?>" ;
        });


        Blade::if('unread',function($notification){

            if(is_null($notification->read_at)){
                return false;
            }
            return true;
        });

        
    }
}
