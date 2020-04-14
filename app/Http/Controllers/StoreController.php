<?php

namespace App\Http\Controllers;

use Auth;
use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
{

    public function __construct(){
        $this->middleware("auth")->except("show");
    }
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
    public function create()
    {
        return view("store.create");
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
                'name' => ['required', 'string', 'max:50','unique:stores'],
                'owner' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255'],
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

                return view("store.dashboard")->with('data',$data);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        return view("store.index",compact('store'));
    }

    
    /**
     * Display the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function inventory(Store $store)
    {
        $data = [
            'store'=>$store
        ];
        return view("store.inventory",['data'=>$data]);

    }


        /**
     * Display the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show_admin(Store $store)
    {
        $data = [
            'store'=>$store
        ];
        return view("store.dashboard")->with('data',$data);
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
    public function update(Request $request, Store $store)
    {
        //
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
}
