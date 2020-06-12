<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
	protected $table = 'listing';
	public $timestamps = false;

    public function user(){
    	return $this->hasOne('App\User','id','user_id');
    }

    public function moreUser(){

        return $this->belongsTo('App\User');
    }
}
