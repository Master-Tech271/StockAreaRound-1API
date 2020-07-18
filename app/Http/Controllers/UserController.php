<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;
// use App\Http\Requests\UserRequestController;

class UserController extends Controller
{
    public $successStatus = 200;

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required', 
            'confirmPassword' => 'required|same:password', 
        ]);
        if ($validator->fails()) { 
                    return response()->json(['error'=>$validator->errors()], 401);            
                }

                $res = DB::transaction(function () use ($request){                 
                    $input = $request->all(); 
                    $input['password'] = $input['password']; 
                    $user = User::create($input); 
                    $success['token'] =  $user->createToken('Token')->accessToken; 
                    $success['name'] =  $user->name;  
                    return response()->json(['success'=>$success], $this->successStatus);                    
                });

                return $res;

        
    }

    public function login(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')->accessToken; 
            return response()->json(['success' => $success], $this->successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }

    public function userDetails() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], $this->successStatus); 
    } 
}
