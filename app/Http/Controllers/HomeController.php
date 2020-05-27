<?php

namespace App\Http\Controllers;

use App\Address;
use Illuminate\Http\Request;
use App\FeaturedProduct;
use App\Product;
use App\Avatar;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth')->except("");
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //find user stores
        $user = Auth::user();
        $store = $user->stores;
        return view('home',["store"=>$store]);
    }

    protected $products_per_page = 15;

    public function retrieve(Request $request, $type = null) {

       $products = Product::orderby("created_at","desc")->paginate($this->products_per_page);

       
       $Featured = FeaturedProduct::all();
    
        return view('welcome')->with(compact('products','Featured'));

    }

    public function getProducts(){
    $products = Product::all();
    $products_list = array();
    foreach($products as $product){

        $item = [
            "title"=>$product->title,
            "description"=>$product->description,
            "tags"=>explode(',',$product->tags)
        ];
        
        array_push($products_list,$item);
    }

            json_encode($products_list);

            return response()->json($products_list);
    }

    public function search($query){

       $search = "%$query%";
      $data = Product::where("title","LIKE",$search)
                        ->orWhere("tags","LIKE",$search)
                        ->orWhere("type","LIKE",$search)
                        ->orWhere("brand","LIKE",$search)->get();
        
                $products_list = array();
                foreach($data as $d){
                    $item = [
                        "title"=>$d->title,
                        "description"=>$d->description,
                        'url'=>route('product.view',['product'=>$d]),
                        "image"=>$d->getImage("thumbnail")
                    ];

                    array_push($products_list,$item);
                }
                    return response()->json($products_list);      
       
    }

    public function updatePhoto(Request $request){
        $user = Auth::user();

        $data = request()->validate([
            'image'=>'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $image = $request->file("image");

        if(!is_null($image)){

            //rename image file
            $image_name = $user->firstname[0] .$user->lastname.'_'.$user->id. '.' . $image->getClientOriginalExtension();
            
     
          if(is_null($user->image)){
              $user->avatar = new Avatar;
          }
          $user->avatar->image = $image_name;
          $user->avatar->user_id = $user->id;
        //   $user->image->imageable_type = "App\User";
        //   $user->image->imageable_id = $user->id;
          $user->avatar->save();

            $destinationPath = public_path('avatars');
            $resize_image = Image::make($image->getRealPath());
            $resize_image->resize(192, 192, function($constraint){
            $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_name);
        }
        return response()->json("success");
    }

    public function updateProfile(Request $request){
        $this->validate($request,[
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string'],
            'street' => ['required', 'string', 'min:8'],
            'phone' => 'required','numeric', 'min:10', 'max:10', 'unique:users',
            'parish' => ['required', 'string'],

        ]);

        $user = Auth::user();
        $user->update([
            'firstname'=>$request->firstname,
            'lastname'=>$request->lastname,
            'phone'=>$request->phone
        ]);

        if($user->address == null){
            $user->address = new Address;
        }

        $user->address->update([
            'country'=>$request->country,
            'parish'=>$request->parish,
            'street'=>$request->street,
            'addressable_type'=>"App\User",
            'addressable_id'=>$user->id
        ]);

        return redirect()->back();

    }
}
