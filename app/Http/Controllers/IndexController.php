<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use DateTime;
class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
       if($id == null){
            $alluser =  User::orderBy('id','desc')->get();
            return response()->json($alluser);
        }else{
            $alluser = $this->show($id);
             return response()->json($alluser);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $users = User::orderBy('id','desc')->get();
        
        return $users;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request,
            [
                'name' => 'required|max:10',
                'age' => 'required|digits_between:1,2|min:1',
                'photo' => 'required|mimes:jpeg,png,jpg,gif|max:10000',
                'address' => 'required|max:300',
            ],
            [
                'name.required' => 'Please enter name user',
                'name.max' => 'Name user not  over 10 characters',
                'address.max' => 'Address not  over 10 characters',
                'address.required' => 'Please enter address user',
                'age.required' => 'Please enter age',
                'age.min' => 'Over 0',
                'age.digits_between' => 'Not enter over 2 characters',
                'photo.max'=>'Image not upload over 10MB',
                'photo.mimes'=>'The image must be a file of type: jpg, png, gif.',
                
                
            ]);
        $user = new User;
        $user->name = $request->name;
        $user->age = $request->age;
        $user->address = $request->address;
        if($request->hasFile('photo')){
            $file = $request->file('photo');
            
            $name = $file->getClientOriginalName();
            $tenHinh = time().'_'.str_random(4)."_".$name;
            while(file_exists("uploads/users/".$tenHinh)){
                $tenHinh = str_random(4)."_".$name;
            }
            $file->move("uploads/users",$tenHinh);
            $user->photo = $tenHinh;
        }

        
        $user->created_at = new DateTime();
        $user->save();
        $users = User::orderBy('id','desc')->get();
        $response = [
            'data' => $users,
            'message' => 'Add success user'.$request->name,
        ];
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //users/id/edit
       $us = User::find($id);
        return $us;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $req)
    {
             
             $this->validate($req,
            [
                'name' => 'required|max:10',
                'age' => 'required|digits_between:1,2|min:1',
                'photo' => 'image|mimes:jpeg,png,jpg,gif|max:10000',
                'address' => 'required|max:300',
            ],
            [
                'name.required' => 'Please enter name user',
                'name.max' => 'Name user not  over 10 characters',
                'address.max' => 'Address not  over 10 characters',
                'address.required' => 'Please enter address user',
                'age.required' => 'Please enter age',
                'age.min' => 'Over 0',
                'age.digits_between' => 'Not enter over 2 characters',
                'photo.max'=>'Image not upload over 10MB',
                'photo.mimes'=>'The image must be a file of type: jpg, png, gif.',
                
                
            ]);
             
            $us = User::find($id);
            if($req->hasFile('photo')){
            $file = $req->file('photo');
            
            $name = $file->getClientOriginalName();
            $tenHinh = time().'_'.str_random(4)."_".$name;
            while(file_exists("uploads/users/".$tenHinh)){
                $tenHinh = time().'_'.str_random(4)."_".$name;
            }
            $file->move("uploads/users",$tenHinh);
            $us->photo = $tenHinh;
            }else{
               
            }
            $us->name = $req->name;
            $us->age = $req->age;
            $us->address = $req->address;
            
            $us->save();

        return User::orderBy('id','desc')->get();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //users/id/destroy
        $user = User::find($id);
        $user->delete();
        return User::orderBy('id','desc')->get();
    }
    public function test(){
        return ['message'=>'success'];
    }
}
