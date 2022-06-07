<?php

namespace App\Http\Controllers;
use App\Models\admin_login;
use App\Models\newuser;
use Illuminate\Http\Request;
use App\Models\password;
class EmployeeController extends Controller
{
    public function users(){

        if(session('username')){
            $logins=admin_login::orderBy('updated_at','DESC')->get();
        return view('employee.users')->with([
            'employee_users'=>$logins
        ]);
        }else{
            return view('password.session_expired');
        }


       
    }
    public function destroy(Request $request){


        if(session('username')){
            $newusers=newuser::where('username',$request->username);
            $newusers->delete();
            $logins=admin_login::where('username',$request->username);
            $logins->delete();
            return redirect()->route('employee.users');
        }else{
            return view('password.session_expired');
        }


        
    }
    public function images(Request $request){


        if(session('username')){
            $users=password::orderBy('updated_at','DESC')->get();
            return view('employee.update')->with([
                'username' => $request->username,
                'email' => $request->email,
                'address' => $request->address,
                'city' => $request->city,
                'contact_num' => $request->contact_num,
                'users' => $users
            ]);
        }else{
            return view('password.session_expired');
        }


        
    }
    public function add_image(Request $request){


        if(session('username')){
            $file=$request->image->getClientOriginalName();
        $filename = pathinfo($file, PATHINFO_FILENAME);
        $newImgname= $filename. '.' . $request->image->extension();
        $request->image->move(public_path('images'),$newImgname);
        $password=password::where('username',$request->username)->first();
        password::create([
            'username' => $password->username,
            'email' => $password->email,
            'address' => $password->address,
            'city' => $password->city,
            'contact_num' => $password->contact_num,
            'img' => $newImgname,
    ]);
    return redirect()->route('employee.images');
           
        }else{
            return view('password.session_expired');
        }



        
        
    }
}
