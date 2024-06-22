<?php

namespace App\Http\Controllers;

//use Facade\FlareClient\Http\Response;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    public function index(){
        return response()->json([
            'greeting'=>"Hello!",
            'message' => "hahaahahah",
            'student' =>[
                'firstname' =>"morning seven",
                'lastname' =>"strike land",
                'address' =>[
                    'city' => "waray",
                    'municipality' => "Carigara",
                    'street' => "Brgy. Barugohay Norte"
                ]
            ]
        ]);
    }
    public function create(Request $request){
        DB::table('users')->insert($request->all());
        return request()->json(['message' => 'User Created!'], 200);
    }
}
