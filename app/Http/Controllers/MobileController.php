<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MobileController extends Controller
{
    public function loginAPI(Request $request){

    	$email = $request->input('email');
    	$password = $request->input('password');
    	$data = array();

    	$user = new User;

    	$getuser = $user->where('email',$email)->first();

    	if($getuser){

    		if(Hash::check($password, $getuser->password)){

    			$token = $this->tokenGenerate();

    			$data1['id'] = $getuser->id;
    			$data1['token'] = $token;
    			$data1['status'] = ['code'=>'200','message'=>'Access Granted'];

    			array_push($data, $data1);

    			$this->updateToken($getuser->id, $token);

    		}else{

    			$data1['status'] = ['code'=>'401','message'=>'Unauthorized Access'];

    			array_push($data, $data1);
    		}

    	}else{

    		$data1['status'] = ['code'=>'401','message'=>'Unauthorized Access'];

    		array_push($data, $data1);
    	}

    	return json_encode($data);
    }

    public function authenticate($email, $token){

    	$user = new User;

    	$getuser = $user->where('id',$email)->first();

    	if($getuser){

    		if($token == $getuser->token){

    			return true;

    		}else{

    			return false;
    		}

    	}else{

    		return false;

    	}
    }

    public function tokenGenerate(){

    	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < 30; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
    }

    public function updateToken($id,$token){

    	$user = new User;

    	$user->where('id',$id)->update(['token'=>$token]);
    }
}
