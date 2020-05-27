<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Notifications\productRequest;
use App\Notifications\sendMessage;
use Illuminate\Support\Facades\DB;
use App\Store;
use App\Product;
use Carbon\Carbon;
use App\Cart;
use Session;
use Auth;
use Exception;

use function GuzzleHttp\json_decode;

class NotificationController extends Controller
{
    public function sendMessage(Request $request){
        $data = request()->validate([
            'subject'=>'required','max:50',
            'message'=>'required','max:255',
            'from'=>'required','email','max:255',
            'to'=>'required','email','max:255',
        ]);

        $message= [
            'from'=>Auth::user(), //ccurrent logged in user
            'message'=>$data['message'], //message to send
            'subject'=>$data['message'], //subject
            'photo'=>Auth::user()->avatar ? asset('avatars/'.Auth::user()->avatar->image) :asset('avatars/default-user.jpg'),
        ];

      $supplier = User::whereEmail($data['to'])->first();
       $supplier->notify(new sendMessage($message));

        $arr = array('msg' => 'Email sent', 'status' => true);
       return Response()->json($arr);  
    }

    public function requestProducts(Request $request){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $data = array();


        //loop through each cart item
        foreach($cart->items as $item){
            $data= [
                    'item'=>$item,
                    'subject'=>'Product request',
                    'email'=>Auth::user()->email,
                    'phone'=>Auth::user()->phone,
                    'name'=>Auth::user()->firstname.' '.Auth::user()->lastname
            ];   
   
            //notify the store
            $store = Store::find($item['storeid']);
            $store->notify(new ProductRequest($data));
    }
       
    //empty cart
    $request->session()->forget('cart');
    //return back
    return redirect()->back()->with("message","Items requested");
}



public function request_single($id){
    $oldCart = Session::has('cart') ? Session::get('cart') : null;
    $cart = new Cart($oldCart);
    //search the cart for a particular item
    
    $item = $cart->items[$id];

    $data= [
        'item'=>$item,
        'subject'=>'Product request',
        'email'=>Auth::user()->email,
        'phone'=>Auth::user()->phone,
        'name'=>Auth::user()->firstname.' '.Auth::user()->lastname
];   

   //notify the store
   $store = Store::find($item['storeid']);
   $store->notify(new ProductRequest($data));

    $cart->removeAll($id);
    Session::put('cart',$cart);
    return response()->json("Items requested");
}


//get notification and mark read
public function getProductRequestNotification($id,$storeid){

    $response = [];

    $store = Store::find($storeid);
    $store->unReadNotifications->where('id',$id)->markAsRead();

    $notification = DB::table("notifications")->find($id);

    //get the product
    $product = Product::find(json_decode($notification->data)->product);   
    
    $data = [
        'id'=>$product->id,
        'image'=>$product->getImage("medium"),
        'title'=>$product->title,
        'from'=>json_decode($notification->data)->from
    ];

    return response()->json($data);
}

function message_user(Request $request){

    //validate
    $data = request()->validate([
        'email'=>'required','email','max:255',
        'message'=>'required','string','max:255',
        'subject'=>'required','string','max:255',
    ]);

    //find user
    $user = User::where('email',$data['email'])->first();

    $message= [
        'from'=>Auth::user(),
        'message'=>$data['message'],
        'subject'=>$data['subject'],
        'photo'=>Auth::user()->avatar ? asset('avatars/'.Auth::user()->avatar->image) :asset('avatars/default-user.jpg')
    ];


    $user->notify(new sendMessage($message));
    
    return response()->json("sent");

    //
}

function get_message($id){
    $notification = json_decode(Auth::user()->notifications->where("id",$id)->first());
    $data = [
        "message"=>$notification->data->message,
        "created_at"=>Carbon::parse($notification->created_at)->format("M d, yy"),
        "from"=>$notification->data->from,
        "subject"=>$notification->data->subject
    ];
    Auth::user()->unReadNotifications->where('id',$id)->markAsRead();

    return response()->json($data);
}


//get request item

function get_request_item($id){
    $notification = json_decode(Auth::user()->stores->unreadnotifications->where("id",$id)->first());
    $data = [
        "message"=>Product::find($notification->data->product)->title,
        "created_at"=>Carbon::parse($notification->created_at)->format("M d, yy"),
        "from"=>$notification->data->from
    ];
    Auth::user()->unReadNotifications->where('id',$id)->markAsRead();

    return response()->json($data);
}

//remove notification

public function moveToTrash($id){
    //find notification
    $store = Store::find(Auth::user("store")->id);
    $notification = $store->notifications->find($id);
     $notification->update([
         'trash'=>true
     ]);

    return response()->json("sucess");
}


}
