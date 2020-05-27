<?php

use Illuminate\Support\Facades\Route;
use App\Product;
use App\FeaturedProduct;
use App\Notifications\productNotification;


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

// Route::get('/notify', function () {
//    $data = [
//        "subject"=>"test",
//        "message"=>"hello world"
//    ];
//    Auth::user()->notify(new productNotification($data));
// });
Route::get('storage/{filename}', function ($filename)
{
    // Add folder path here instead of storing in the database.
    $path = storage_path('public/myfolder1' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});


Auth::routes(['verify' => true]);





Auth::routes();

Route::get('/', 'HomeController@retrieve');


Route::get('/home', 'HomeController@index')->name('home')->middleware(("auth"))
->middleware('verified');

Route::post('/update-profile-photo', 'HomeController@updatePhoto')->name('update.profile.photo')->middleware(("auth"))
->middleware('verified');


Route::patch('/update-profile', 'HomeController@updateProfile')->name('update.profile')->middleware(("auth"))
->middleware('verified');

Route::get('/about', function(){
    return view("about");
})->name("about");

//store
Route::prefix('store')->group(function(){
    //create stores
Route::get('create','Auth\StoreLoginController@create')->name("store.create");
Route::post('create','Auth\StoreLoginController@store')->name("store.store");
//login to store
Route::get('login','Auth\StoreLoginController@showLoginForm')->name("store.login");
Route::post('login','Auth\StoreLoginController@login')->name("store.login.dashboard");

Route::get('dashboard','StoreController@show_admin')->name("store.admin-dashboard");

Route::get('inventory','StoreController@inventory')->name("store.inventory");
Route::get('notifications','StoreController@getNotifications')->name("store.notifications");
Route::get('settings','StoreController@getSettings')->name("store.settings");



Route::get('/{store}','StoreController@show')->name("store.index");
Route::get('/Analytics/{period}','StoreController@analytics')->name("store.analytics");
Route::get('/get-store-chart-data/{id}/{period}','StoreController@pastDateViewsChart');



Route::put('/settings/{store}','StoreController@update')->name('store.settings.update');
Route::put('/trash/{storeid}','StoreController@getTrash')->name('store.');
});


//products
Route::prefix('product')->group(function(){
Route::get('create/{store}/{product_type}','ProductController@create')
->name("product.create");

Route::get("add-image/{store}/{product}",'ProductController@addImage')->name("add.images");

Route::post("upload/{product}",'ProductController@upload')->name("image.upload");


Route::get('view/{product}','ProductController@show')->name("product.view");

Route::post('create/','ProductController@getdata')->name("product.store");

Route::put('save/{product}','ProductController@store')->name('product.save');

Route::get('edit/{store}/{product}','ProductController@edit')->name("product.edit");

Route::delete('delete/','ProductController@destroy')->name('product.destroy');

Route::put('update/{product}','ProductController@update')->name("product.update");
Route::post('review/{id}','ProductController@review')->name("product.review");
Route::get('feature/{id}','ProductController@getFeature')->name("product.feature");
Route::post('feature/{id}/{type}','ProductController@store_featured')->name("product.store.feature");
Route::get('remove-featured/{id}','ProductController@removeFeatured')->name("remove.featured");
});

Route::get('add-to-cart/{id}', 'ProductController@addToCart')->name("product.addToCart");
Route::get('cart', 'ProductController@getCart')->name("cart.items");


Route::post('/send-message','NotificationController@sendMessage')->name("send.message");

Route::get('/cart-delete/{id}','ProductController@getRemoveAll')->name("remove.all");
Route::get('/cart-delete-one/{id}','ProductController@getRemoveByOne')->name("remove.one");

Route::get('/getProductRequestNotification/{id}/{storeid}','NotificationController@getProductRequestNotification');
Route::get('/move-to-trash/{id}','NotificationController@moveToTrash');

Route::post('/message-user','NotificationController@message_user')->name("message.user");

Route::get('/get-message/{id}','NotificationController@get_message');
Route::get('/get-repquest-item/{id}','NotificationController@get_request_item');

Route::post('request','NotificationController@requestProducts')->name("products.request");

Route::get('/request-item/{id}','NotificationController@request_single');

//ass store password

Route::get('update','Auth\StoreLoginController@getAddPassword')->name("add.store.password");
Route::PUT('store/update','Auth\StoreLoginController@addPassword')->name("update.store.password");

Route::get("products/all/json",'HomeController@productsJson');