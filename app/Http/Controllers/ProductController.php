<?php

namespace App\Http\Controllers;

use App\Product;
use App\Store;
use App\Cart;
use App\FeaturedProduct;
use Carbon\Carbon;

use Auth;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\ImageManagerStatic as Image;

class ProductController extends Controller
{

    public function __construct(){
        $this->middleware("auth")->except(['show','addToCart','getCart']);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Store $store, $product_type)
    {
           
            return view("product.create",compact('store'))->with('product_type',$product_type);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getdata(Request $request)
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
            'currency'=>['required','string','max:3'],
            'featured'=>'nullable',
        ]);
        $data['featured'] = false;
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
                        'features'=>['nullable','string'],
                    ]);
                break;
                case 'fashion':
                case 'electronic':
                break;
            default:
            return redirect()->back();
            break;  
        }

        //creat product temperarly
       $store->products()->create(array_merge($data));

     
         $product = $store->products()->orderBy('id','desc')->first();

         return redirect()->route("add.images",compact('store','product'));
           
        }

        public function addImage(Store $store, Product $product){
            //delete product before dave
            // Product::find($product->id)->delete();
            return view("product.addimages",compact('store','product'));
           
        }

        public function upload(Request $request, Product $product){
                  // //product images
            if($request->hasFile('file')){
                $image = $request->file('file');
                $imageURL = $image->store('public');
                $parameters['image'] = substr($imageURL, 7);

                $product->images()->create([
                    'image'=>$parameters['image']
                    ]);

            



            //thumbnail
            $destinationPath = public_path('product_images/thumbnail');
            $resize_image = Image::make($image->getRealPath());
            $resize_image->resize(60, 60, function($constraint){
            $constraint->aspectRatio();
            })->save($destinationPath . '/' . $parameters['image']);

            
            //medium
            $destinationPath = public_path('product_images/medium');
            $resize_image = Image::make($image->getRealPath());
            $resize_image->resize(150, 150, function($constraint){
            $constraint->aspectRatio();
            })->save($destinationPath . '/' . $parameters['image']);

            
            $destinationPath = public_path('product_images/');

            $resize_image = Image::make($image->getRealPath());
            $resize_image->resize(function($constraint){
            $constraint->aspectRatio();
            })->save($destinationPath . '/' . $parameters['image']);
        }
        
    }


    public function store(Product $product){
        $product->save();
       //find store

       return redirect()->route('product.view',compact('product'));
    }



        
    
    

    /**
     * Display the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        views($product)->record();
        return view("product.index",compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store, Product $product)
    {
   
        return view("product.edit",compact('product'))->with('store',$store);;

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
            'currency'=>['required','string','max:3'],
            // 'image0'=>'required|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            // 'image1'=>'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            // 'image2'=>'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
        ]);
        $data['type'] = $request->type;
        
       
        switch($request->type){
            case 'farm':
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
                        'features'=>['required','string']
                    ]);
                break;
                case 'fashion':
                case 'electronic':
                break;
            

            default:
            return redirect()->back();
            break;  
        }

      //  save image
   
       $product->update(array_merge($data));

    //    // product images
    //     $images = [
    //         "image0"=>$request->file("image0"),
    //         "image1"=>$request->file("image1"),
    //         "image2"=>$request->file("image2")
    //     ];

    //      $this->updateImage($images,Product::all()->last());

      //   redirect to inventory
     
        $store = $product->store;
        return redirect()->route("store.inventory",compact('store'));

    }

     public function UpdateImage($images,$product){
            for($i =0;$i< $product->images->count();){

            if(!\is_null($product->images[$i])){
              // The file exists, so we save it to project/storage/app/public, and get the URL. In case, we will get 'public/fileName'
                $imageURL = $image->store('public');
                // However, we only want to insert pure file name into the database, so we remove the 'public' and only leave 'fileName'
                $parameters['image'] = substr($imageURL, 7);
                // Get the instance of the item I just inserted
           
                  $product->images()->create([
                'image'=>$parameters['image'],
            ]);
                // Set the driver
                Image::configure(array('driver' => 'gd'));

                //medium image
                Image::make(storage_path('app/public/' . $parameters['image']))
                ->resize(150, 150,function($constraint){
                    $constraint->aspectRatio();
                })
                ->save(storage_path('app/public/medium/' . $parameters['image']));

                // //thumnbnail
                Image::make(storage_path('app/public/' . $parameters['image']))
                ->resize(50, 50,function($constraint){
                    $constraint->aspectRatio();
                })
                ->save(storage_path('app/public/thumbnail/' . $parameters['image']));

        }
    }
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $product = Product::find($request->product_id);
        $product->delete();
        return back();
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


$cart->add($product, $product->id,$product->store->id);

$request->session()->put('cart',$cart);

return response()->json("success");

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

    $product->featured = true;
    $product->save();

    return redirect()->route('store.inventory',compact('store'));
}


public function removeFeatured($id){
     FeaturedProduct::where("product_id",$id)->delete();

     Product::find($id)->update([
        'featured' => false
     ]);
    return redirect()->back();
}


public function request(){
    if(!Session::has('cart')){
        return view('cart-list');
    }
    $oldCart = Session::get('cart');
    $cart = new Cart($oldCart);
    
    //send supplier notification
    }


    public function getRemoveByOne($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeByOne($id);
        Session::put('cart',$cart);
        return redirect()->back();

    }


    public function getRemoveAll($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeAll($id);
        Session::put('cart',$cart);
        return redirect()->back();
    }



}





