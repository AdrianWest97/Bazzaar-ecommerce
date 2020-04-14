<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Mail\Product as sendMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{


    public function __construct(){
        $this->middleware("auth");
    }


    public function product_query(Request $request){

        $data = request()->validate([
            'subject'=>'required','max:50',
            'message'=>'required','max:255',
            'from'=>'required','email','max:255',
            'to'=>'required','email','max:255',
        ]);

        Mail::to($data['to'])->send(new sendMail($data));

        $arr = array('msg' => 'Email sent', 'status' => true);

        if(Mail::failures()){
            $arr = array('msg' => 'Something went. Please try again lator', 'status' => false);
        }
        return Response()->json($arr);  
        }

    }
