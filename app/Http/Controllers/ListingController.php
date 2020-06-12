<?php

namespace App\Http\Controllers;

use App\Listing;
use App\Http\Controllers\MobileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
	public function listing(){

		$listing = new Listing;

	    $listing_data = $listing->where('user_id',Auth::user()->id)->get();

	    return view('listing',compact('listing_data'));

	}

    public function list(Request $request){

    	$email = $request->input('id');
    	$token = $request->input('token');

    	$pass = $this->authenticate($email, $token);

    	if($pass){

    		$listing = new Listing;

	    	$listing_data = $listing->where('user_id',$email)->get();

	    	return json_encode($listing_data);

    	}else{

    		$data1['status'] = ['code'=>'401','message'=>'Unauthorized Access'];

    		return json_encode($data1);
    	}
    }

    public function addnew(Request $request){

    	$name = $request->input('name');
    	$distance = $request->input('distance');

    	$listing = new Listing;

        $listing->list_name = $name;
        $listing->distance = $distance;
        $listing->user_id = Auth::user()->id;

        $listing->save();

        return "200";
    }

    public function remove(Request $request){

    	$id = $request->input('listingid');

    	$listing = new listing;

    	$listing->where('id', $id)->delete();

    	return "200";
    }

    public function update(Request $request){

    	$email = $request->input('id');
    	$token = $request->input('token');
    	$list_id = $request->input('listing_id');
    	$list_name = $request->input('list_name');

    	$pass = $this->authenticate($email, $token);

    	if($pass){

    		$listing = new Listing;

	    	$listing_data = $listing->where('id',$list_id)->update(['list_name'=>$list_name]);

	    	$data1['status'] = ['code'=>'200','message'=>'Update Success'];

	    	return json_encode($data1);

    	}else{

    		$data1['status'] = ['code'=>'401','message'=>'Unauthorized Access'];

    		return json_encode($data1);
    	}
    }

    public function authenticate($email, $token){

    	$mc = new MobileController;

    	return $mc->authenticate($email, $token);
    }
}
