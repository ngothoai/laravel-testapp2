<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DateTime;

class ControllerUser extends Controller
{
    public function index($id = null){
    	if($id == null){
    		return User::orderBy('id','desc')->get();
    	}else{
    		return $this->show($id);
    	}
    }
    public function store(Request $req){
    	
    	$user = new User;
    	$user->name = $req->input('name');
    	$user->age = $rq->input('age');
    	$user->address = $req->input('address');
    	$user->photo = $req->input('photo');
    	$user->created_at = new DateTime();
    	$user->save();
    	return "Add success user".$user->id;
    }
    public function show($id){
    	return User::find($id);
    }
     public function update(Request $req, $id){
     	$us = User::find($id);
    	$us->name = $req->input('name');
    	$us->age = $rq->input('age');
    	$us->address = $req->input('address');
    	$us->photo = $req->input('photo');
    	$us->created_at = DateTime();
    	$us->save();
    	return "Add success update user".$us->id;
    }
    public function destroy(Request $req){
    	$user = User::find($req->input('id'));
    	$user->delete();
    	return "Delete succsess user" .$user->id;
    }
}
