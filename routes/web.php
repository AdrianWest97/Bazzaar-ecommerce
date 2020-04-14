<?php

use Illuminate\Support\Facades\Route;
use App\Product;
use App\FeaturedProduct;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::get('/', function () {
    return view('welcome',['products'=>Product::all(),'Featured'=>FeaturedProduct::all()]);
});



Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/about', function(){
    return view("about");
})->name("about");

//store
Route::prefix('store')->group(function(){
Route::get('create','StoreController@create')->name("store.create");
Route::post('create','StoreController@store')->name("store.store");
Route::get('dashboard/{store}','StoreController@show_admin')->name("store.show.admin");
Route::get('inventory/{store}','StoreController@inventory')->name("store.inventory");
Route::get('/{store}','StoreController@show')->name("store.index");
});

//products
Route::prefix('product')->group(function(){
Route::get('create/{store}/{product_type}','ProductController@create')->name("product.create");
Route::get('view/{product}','ProductController@show')->name("product.view");
Route::post('create/','ProductController@store')->name("product.store");
Route::post('edit/{id}','ProductController@update')->name("product.edit");
Route::post('review/{id}','ProductController@review')->name("product.review");
Route::get('feature/{id}','ProductController@getFeature')->name("product.feature");
Route::post('feature/{id}/{type}','ProductController@store_featured')->name("product.store.feature");
});

Route::get('add-to-cart/{id}', 'ProductController@addToCart')->name("product.addToCart");
Route::get('cart', 'ProductController@getCart')->name("cart.items");
Route::post('sendMail','MailController@product_query')
->name('send.mail.query');
