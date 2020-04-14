<?php

namespace App\Http\Controllers;

use App\Product;
use App\Store;
use App\Farm;
use App\Cart;
use App\Review;
use App\User;
use App\FeaturedProduct;
use Image;
use Carbon\Carbon;

use Auth;
use Illuminate\Http\Request;
use Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Store $store, $product_type)
    {
            $data = [
                'store'=>$store,
                'product_type'=>$product_type
            ];
            return view("product.create")->with('data',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $check = false;

        $user = Auth::user();
        $store = store::find($request->storeid);

        $data = request()->validate([
            'title'=>['required','string','max:255'],
            'vendor'=>['required','string','max:255'],
            'location'=>['required','string','max:255'],
            'price'=>['required','numeric'],
            'tags'=>['required','string','max:255'],
            'description'=>['required','string','max:255'],
            'image0'=>'required|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'image1'=>'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'image2'=>'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
        ]);
        $data['type'] = $request->type;
        
        switch($request->type){
            case 'farm':
            case 'appliance':
                $data += request()->validate([
                    'quantity'=>['required','numeric'],
                    'weight'=>['required','numeric'],
                    'unit'=>['required','string'],
                ]);
                break;
            
                case 'car':
                    $data += request()->validate([
                        'make'=>['required','string'],
                        'model'=>['required',''],
                        'transmission'=>['required','string'],
                        'year'=>['required','numeric'],
                    ]);
                break;
                case 'fashion':
                break;
            

            default:
            return redirect()->back();
            break;  
        }

        //save image
   
        $store->products()->create(array_merge($data));

        //product images
        $images = [
            "image0"=>$request->file("image0"),
            "image1"=>$request->file("image1"),
            "image2"=>$request->file("image2")
        ];

         $this->saveImage($images,Product::all()->last());

         //redirect to inventory
         $data = [
            'store'=>$store
        ];
        
         return view("store.inventory",['data'=>$data]);


    }

        public function saveImage($images,$product){
            foreach($images as $image){
            if(!\is_null($image)){
            $image_name = uniqid() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('products/thumbnail');


            $resize_image = Image::make($image->getRealPath());

            $resize_image->resize(150, 150, function($constraint){
            $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_name);

            $destinationPath = public_path('products/thumbnail_smaller');

            $resize_image->resize(60, 54.8, function($constraint){
                $constraint->aspectRatio();
                })->save($destinationPath . '/' . $image_name);

            $destinationPath = public_path('products/product_images');
            $image->move($destinationPath, $image_name);
            //save in
            $product->images()->create([
                'image'=>$image_name,
            ]);

        }
    }
        }

   

        
    
    

    /**
     * Display the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        return view("product.index",compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {

        //find store
        $data = [
            'store'=>$product->store
        ];
        return view("product.edit",compact('product'))->with('data',$data);;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product)
    {
        //
    }

    //make product features
public function feature_product(Product $product){
    
}

//cart
public function cart()
{
    return view('cart');
}





public function addToCart(Request $request, $id)
{
    
 $product = Product::find($id);
     
$oldCart = Session::has('cart') ? Session::get('cart') : null;

$cart = new Cart($oldCart);

$cart->add($product, $product->id);

$request->session()->put('cart',$cart);
return \redirect()->back();
}

public function getCart(){
    if(!Session::has('cart')){
        return view('cart-list');
    }
    $oldCart = Session::get('cart');
    $cart = new Cart($oldCart);
    return View('cart-list',['products'=>$cart->items, 'totalPrice'=>$cart->totalPrice]);
}


public function review($id, Request $request){

    $product = Product::find($id);

    //check if a registered user

    $data = request()->validate([
        'username'=>['required','string','max:255'],
        'review'=>['required','string','max:255'],
        'email'=>['required','email','max:50'],
        'rating'=>'required'
    ]);


     
         //check if session exits
         if(!Session::has('temp_user')){
             $request->session()->put('temp_user',$data['email']);
         }
     

    $message = "You already review this item";

     if(!$product->reviews->contains('email',$data['email'])){
            $product->reviews()->create(array_merge($data));
            $message = "Your review added!";
     }

     return redirect()->back()->with('message',$message);
    
}


public function getFeature($id){

    $product = Product::find($id);

    return view('product.feature-product',compact('product'));

}


public function store_featured($id,$type){

    //find product
    $product = Product::find($id);
    //find store
    $store = $product->store;

    //update
    $store->featuredProducts = new FeaturedProduct;
    $start = Carbon::now();
    $end = $start->addDays(7);
    $diff = $end->diffInDays($start);

    $store->featuredProducts->create([
        'store_id' =>$store->id,
        'product_id'=>$product->id,
        'start'=>$start,
        'end'=> $end,
        'type'=>$type,
        'number_days'=>$diff

    ]);
}


}

