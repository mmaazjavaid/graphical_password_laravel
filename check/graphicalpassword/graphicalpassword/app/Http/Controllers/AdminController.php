<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\admin_failedlogin;
use App\Models\admin_login;
use App\Models\admin_resetpassword;
use App\Models\Employee;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function check(Request $request){

        $session=$request->all();
        $request->session()->put('username',$session['username']);
   
        $manager=admin::where('adminname',$request->username)->first();
        $employee=Employee::where('employeename',$request->username)->first();
        if($manager){
            if($manager->password==$request->password){
                return redirect()->route('admin.logins');
            }
        }elseif($employee){
            
            if($employee){
                if($employee->password==$request->password){
                    return redirect()->route('employee.users');
                }
            }
        }else{
            return view('password.roles_validation')->with([
                'message'=>'Username or password is incorrect'
            ]);
        }
        
    }
    public function roles(){
        // if (session()->has('username')) {
        //     return redirect()->route('admin.logins');
        // }else
        return view('password.login_for_roles');
    }
    public function logins(){
        
        if(session('username')){
            $logins=admin_login::orderBy('updated_at','DESC')->get();
            return view('admin.admin_logins_table')->with([
                'admin_logins'=>$logins
            ]);
        }else{
            return view('password.session_expired');
        }
       
    }
    public function failed(){


        if(session('username')){
            $logins=admin_failedlogin::orderBy('updated_at','DESC')->get();
            return view('admin.admin_failedlogins_table')->with([
                'admin_logins'=>$logins
            ]);
        }else{
            return view('password.session_expired');
        }


        
    }
    public function resets(){


        if(session('username')){
            $logins=admin_resetpassword::orderBy('updated_at','DESC')->get();
            return view('admin.admin_resets_table')->with([
                'admin_logins'=>$logins
            ]);
        }else{
            return view('password.session_expired');
        }


        

    } 
    public function unlock(Request $request){
       $user=admin_failedlogin::where('username',$request->username)->first();
       $user->update([
           'failed_attempts'=>'0'
       ]);
       return redirect()->route('admin.failed');
    }
}
