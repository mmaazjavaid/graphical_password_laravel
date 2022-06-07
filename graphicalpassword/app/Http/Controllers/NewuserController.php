<?php

namespace App\Http\Controllers;
use App\Models\password;
use Illuminate\Http\Request;
use App\Models\newuser;
class NewuserController extends Controller
{
    public function store(Request $request){
       
        
        $img=password::where('img',$request->img)->first();
            if(($img->selected_image)=='0'){
                password::where('img',$request->img)->update([
                'selected_image'=>'1',
                ]);
                
            }else{
                password::where('img',$request->img)->update([
                'selected_image'=>'0',
                ]);
               
            } 
            $allusers=password::orderBy('updated_at','DESC')->get();
        newuser::create([
            'username' => $request->username,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'contact_num' => $request->contact_num,
            'img' => $request->img,
    ]);
    $totalusers=newuser::where('username',$request->username)->get();
    if(count($totalusers)=='5'){
        return view('select')->with([
            'username' => $request->username,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'contact_num' => $request->contact_num,
            'users' => $allusers,
            'submit_button'=>'on'
        ]);
                    
    }
    return view('select')->with([
        'username' => $request->username,
        'email' => $request->email,
        'address' => $request->address,
        'city' => $request->city,
        'contact_num' => $request->contact_num,
         'users' => $allusers,
         'submit_button'=>'off'
    ]);
    }
}
