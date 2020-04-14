<?php

namespace App\Http\Controllers;

use App\Farm;
use App\Store;
use Illuminate\Http\Request;

class FarmController extends Controller
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
    public function create(Store $store)
    {
        $store = [
            'store'=>$store
        ];
        return view("product.create",['store'=>$store['store']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'name'=>['required','string','max:255'],
            'vendor'=>['required','string','max:255'],
            'type'=>['required','string','max:255'],
            'location'=>['required','string','max:255'],
            'quantity'=>['required','string','max:255'],
            'price'=>['required','string','max:255'],
            'tags'=>['required','string','max:255'],
            'description'=>['required','string','max:255'],
        ]);

        
        $user = Auth::user();
        // $user->stores->find($request->storeid)->products()->create([
        //     'name'=>$data['name'],
        //     'vendor'=>$data['vendor'],
        //     'type'=>$data['type'],
        //     'location'=>$data['location'],
        //     'quantity'=>$data['quantity'],
        //     'price'=>$data['price'],
        //     'tags'=>$data['tags'],
        //     'description'=>$data['description'],
        // ]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Farm  $farm
     * @return \Illuminate\Http\Response
     */
    public function show(Farm $farm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Farm  $farm
     * @return \Illuminate\Http\Response
     */
    public function edit(Farm $farm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Farm  $farm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Farm $farm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Farm  $farm
     * @return \Illuminate\Http\Response
     */
    public function destroy(Farm $farm)
    {
        //
    }
}
