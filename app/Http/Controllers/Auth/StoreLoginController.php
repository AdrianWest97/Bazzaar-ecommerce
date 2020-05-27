<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Store;
use Auth;
use Hash;
class StoreLoginController extends Controller
{
    public function __construct()
    {
      $this->middleware('guest:store');
    }


     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $this->validate($request,[
                'name' => ['required', 'string', 'max:50'],
                'owner' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255'],
                'phone' => ['required', 'numeric', 'min:10'],
                'password' => ['required', 'password', 'min:8'],
                'description' => ['required', 'string', 'max:255'],
                'country' => ['required', 'string', 'max:255'],
                'street' => ['required', 'string', 'max:255'],
                'parish' => ['required', 'string', 'max:255'],
                ]);

                $user = Auth::user();
                if(!$user->supplier){
                    $user->supplier = true;
                    $user->save();
                }

                $user->stores = new Store;

                $user->stores()->create([
                    'name'=>$request->name,
                    // 'type'=>$request->type,
                    'description'=>$request->description,
                    'owner'=>$request->owner,
                    'email'=>$request->email,
                    'phone'=>$request->phone,
                    'password'=>Hash::make($request->password)
                ]);

                $id = $user->stores->where('name',$request['name'])->first()->id;

                $user->stores->find($id)->address()->create([
                    'country'=>$request['country'],
                    'street'=>$request['street'],
                    'parish'=>$request['parish'],
                ]);

                $data = [
                    'store'=>$user->stores->find($id)
                ];

                $store = Store::find($id);
                //find store 

                return redirect()->route('store.admin-dashboard',compact("store"));


    }
    

            /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("auth.register-store");
    }

//store login form
    public function showLoginForm()
    {
      return view('auth.login-store');
    }

    public function login(Request $request)
    {
      // Validate the form data
      $this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required|min:6'
      ]);

      // Attempt to log the user in
      if (Auth::guard('store')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
        // if successful, then redirect to their intended location
        //get store if
        return redirect()->intended(route('store.admin-dashboard'));
      }

      // if unsuccessful, then redirect back to the login with the form data
       return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    



    //add store password
    public function getAddPassword(){
      return view('auth.update-password');
    }

    public function addPassword(Request $request){
      $this->validate($request, [
        'password' => 'required|min:8'
      ]);

      Auth::user()->stores->update([
        'password'=>Hash::make($request->password)
      ]);

      return redirect()->route("store.login");

    }
}
