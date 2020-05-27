<?php

namespace App\Http\Controllers;

use App\Notifications\notification_list;
use App\Product;
use App\User;
use Auth;
use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class StoreController extends Controller
{

    public function __construct(){
        $this->middleware(["auth:store"])->except('show');
        $this->middleware(["auth:web"]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        views($store)->record();
        return view("store.index",compact('store'));
    }

    
    /**
     * Display the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function inventory()
    {
        $store = Store::find(Auth::user()->stores->id);

        return view("store.inventory",compact('store'));
    }


        /**
     * Display the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show_admin()
    {
        $store = Store::find(Auth::user()->stores->id);


        


        return view("store.dashboard",compact("store"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $store = Store::find(Auth::user("store")->id);

        $this->validate($request,[
            'name' => ['required', 'string', 'max:50'],
            'owner' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'numeric', 'min:10'],
            // 'password' => ['required', 'password', 'min:8'],
            'description' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'street' => ['required', 'string', 'max:255'],
            'parish' => ['required', 'string', 'max:255'],
            ]);

            $store->update([
                'name'=>$request->name,
                // 'type'=>$request->type,
                'description'=>$request->description,
                'owner'=>$request->owner,
                'email'=>$request->email,
                'phone'=>$request->phone,
                // 'password'=>Hash::make($request->password)
            ]);

            $store->address()->update([
                'country'=>$request['country'],
                'street'=>$request['street'],
                'parish'=>$request['parish'],
            ]);

        return redirect()->route('store.admin-dashboard',compact('store'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        //
    }

    public function analytics($period){

        $store = Store::find(Auth::user()->stores->id);


        return view("store.Analytics",compact('store'))->with('period',$period);
    }

    public function pastDateViewsChart($id,$period){

        $store = Store::find($id);
        return $store->pastDateViewsChart($period);
    }




    public function getNotifications(){
        $store = Store::find(Auth::user()->stores->id);

    //get each notification
    $notification_list = array();
    //all notifications
    foreach($store->notifications->where("trash",false) as $notification){
       
                $product = Product::find(json_encode($notification->data["product"]));
                $notifications =[
                         'type'=>$notification->type,
                         'id'=>$notification->id,
                        'title'=>$product->title,
                        'date'=>Carbon::parse($notification->created_at)->format("M d"),         
                        'read_at'=>$notification->read_at ? Carbon::parse($notification->read_at)->format("M d, yy") : null           
                     ];
                  array_push($notification_list,$notifications);
             }   
      

    $trash = array();
    foreach($store->notifications->where("trash") as $notification){
        $product = Product::find(json_encode($notification->data["product"]));
        $item =[
                 'type'=>$notification->type,
                'id'=>$notification->id,
                'title'=>$product->title,
                'date'=>Carbon::parse($notification->created_at)->format("M d"),         
                'read_at'=>$notification->read_at ? Carbon::parse($notification->read_at)->format("M d, yy") : null           
             ];
          array_push($trash,$item);
    }   
        

    return view('store.notifications',compact('store','notification_list','trash'));
        
    }


    public function getsettings(Store $store){
        $store = Store::find(Auth::user()->stores->id);
        return view("store.settings",compact('store'));
    }


    //get trash
public function getTrash($storeid){
    //find store
    $store = Store::find($storeid);
    $trash = array();
    foreach($store->notifications->where("trash") as $notification){
        $product = Product::find(json_encode($notification->data["product"]));
        $item =[
                 'type'=>$notification->type,
                'id'=>$notification->id,
                'title'=>$product->title,
                'date'=>Carbon::parse($notification->created_at)->format("M d"),         
                'read_at'=>$notification->read_at ? Carbon::parse($notification->read_at)->format("M d, yy") : null           
             ];
          array_push($trash,$item);
         }   

return response()->json($trash);
}

}
