<?php

namespace App\Http\Controllers;

use App\Models\admin_login;
use App\Models\admin_resetpassword;
use Reminder;
use App\Models\newuser;
use App\Models\password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PasswordController extends Controller
{
    public function index(Request $request)
    {

        $validation = $request->validate([
            "username" => "Required"
        ]);
        // $session=$request->all();
        // $request->session()->put('username',$session['username']);
        // dd(session('username'));
        // $allusers=password::where('username','!=',$request->username)->limit(20)->get();
        $logged_user = newuser::where('username', $request->username)->get();
        $user = password::orderBy('updated_at', 'DESC')->get();
        $r_users = array();

        foreach ($user as  $oneuser) {
            array_push($r_users, $oneuser);
        }

        shuffle($r_users);
        $username = $request->input("username");
        if (count($logged_user) > 0) {
            $session = $request->all();
            $request->session()->put('password_user', $session['username']);
            return view('password.login')->with([
                'username' => $request->username,
                'users' => $r_users
            ]);
        }
        //  else return view('incorrect')->with([
        //     'message' => 'user not found',
        //     "username" => $username,
        // ]);
        else return view('password.welcome')->with([
            'messages' => 'user not found',
            "username" => $username,
        ]);
    }
    public function reset_password(Request $request)
    {
        dd($request->all());
    }
    public function forgot_password(Request $request)
    {
        $users = newuser::where('email', $request->email)->get();



        if (count($users) > 0) {
            $this->sendEmail($users);
            return view('success')->with([
                'message' => 'check your email to recover password ',
                'sign_out' => 'off'
            ]);
        } else return view('success')->with([
            'message' => 'user not found',
            'sign_out' => 'off'
        ]);
    }

    public function sendEmail($users)
    {

        foreach ($users as  $user) {
            $username = $user->username;
            $email = $user->email;
            $address = $user->address;
            $city = $user->city;
            $contact_num = $user->contact_num;
            break;
        }


        $to_name = $username;
        $to_email = $email;
        $data = array(
            'username' => $username,
            'email' => $email,
            'address' => $address,
            'city' => $city,
            'contact_num' => $contact_num,
            'body' => 'Click on the button to reset password'
        );
        Mail::send('emails.reminder', $data, function ($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
                ->subject('Password reset mail');
            $message->from('graphicalp38@gmail.com', 'Password reset mail');
        });
    }
    public function select_email_password(Request $request)
    {
        admin_resetpassword::create([
            'username' => $request->username,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'contact_num' => $request->contact_num,

        ]);
        if ($request->deluser == '1') {
            $users = newuser::where('username', $request->username);
            $users->delete();
        }
        $users = password::orderBy('updated_at', 'DESC')->get();


        $session = $request->all();
        $request->session()->put([
            'signedup_user' => $session['username'],
            'email' => $session['email'],
            'address' => $session['address'],
            'city' => $session['city'],
            'contact_num' => $session['contact_num'],
            'users' => $users,

        ]);
        return view('select')->with([
            'username' => $request->username,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'contact_num' => $request->contact_num,
            'users' => $users,
            'submit_button' => 'off'
        ]);
    }
    public function select_pass_validated(Request $request)
    {
        $admin_logins = admin_login::orderBy('updated_at', 'DESC')->get();
        $bool_admin = true;
        foreach ($admin_logins as  $admin_login) {
            if (($admin_login->username == $request->username) && ($admin_login->email == $request->email)) {
                $bool_admin = false;
                break;
            }
        }
        if ($bool_admin == true) {
            admin_login::create([
                'username' => $request->username,
                'email' => $request->email,
                'address' => $request->address,
                'city' => $request->city,
                'contact_num' => $request->contact_num,

            ]);
        }

        $users = password::orderBy('updated_at', 'DESC')->get();
        $session = $request->all();
        $request->session()->put([
            'signedup_user' => $session['username'],
            'email' => $session['email'],
            'address' => $session['address'],
            'city' => $session['city'],
            'contact_num' => $session['contact_num'],
            'users' => $users,

        ]);
        return view('select')->with([
            'username' => $request->username,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'contact_num' => $request->contact_num,
            'users' => $users,
            'submit_button' => 'off'
        ]);
    }
    public function select_password(Request $request)
    {
        $request->validate([
            "username" => "Required",
            "email" => "Required|email",
            "address" => "Required | max:255",
            "contact" => "Required | integer"
        ]);

        if (preg_match('~[0-9]+~', $request->username)) {
            return view('password.validation')->with([
                'message' => 'username must not contain numbers'
            ]);
        }
        $newusers = newuser::orderBy('updated_at', 'DESC')->get();
        foreach ($newusers as $key => $one_newuser) {
            if ($one_newuser->email == $request->email) {

                return view('password.validation')->with([
                    'message' => 'Oops username or email already exists..!'
                ]);
            }
            if ($one_newuser->username == $request->username) {

                return view('password.validation')->with([
                    'message' => 'Oops username or email already exists..!'
                ]);
            }
        }

        return view('password.account_success')->with([
            'username' => $request->username,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'contact_num' => $request->contact,
        ]);
        $users = password::orderBy('updated_at', 'DESC')->get();
        return view('select')->with([
            'username' => $request->username,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'contact_num' => $request->contact,
            'users' => $users
        ]);
    }
    public function login_page()
    {
        return view('password.login');
    }
    // public function store(Request $request){
    // $create_user=true;
    // $allusers=password::orderBy('updated_at','DESC')->get();
    // foreach ($allusers as $key => $users) {
    //     if($users->username==$request->username){
    //         $create_user=false;
    //         break;
    //     }
    // }
    // if($create_user==true){

    //     $file=$request->img_1->getClientOriginalName();
    // $filename_1 = pathinfo($file, PATHINFO_FILENAME);
    // $file=$request->img_2->getClientOriginalName();
    // $filename_2 = pathinfo($file, PATHINFO_FILENAME);
    // $file=$request->img_3->getClientOriginalName();
    // $filename_3 = pathinfo($file, PATHINFO_FILENAME);
    // $file=$request->img_4->getClientOriginalName();
    // $filename_4 = pathinfo($file, PATHINFO_FILENAME);
    // $file=$request->img_5->getClientOriginalName();
    // $filename_5 = pathinfo($file, PATHINFO_FILENAME);

    //     $check_str=$filename_1.$filename_2.$filename_3.$filename_4.$filename_5;
    //     if (substr_count($check_str,$filename_1)>1) {
    //         return back()->with(['message'=>'same images not allowed']);
    //     }
    //     if (substr_count($check_str,$filename_2)>1) {
    //         return back()->with(['message'=>'same images not allowed']);
    //     }
    //     if (substr_count($check_str,$filename_3)>1) {
    //         return back()->with(['message'=>'same images not allowed']);
    //     }
    //     if (substr_count($check_str,$filename_4)>1) {
    //         return back()->with(['message'=>'same images not allowed']);
    //     }
    //     if (substr_count($check_str,$filename_5)>1) {
    //         return back()->with(['message'=>'same images not allowed']);
    //     }

    //     $newImgname_1= $filename_1. '.' . $request->img_1->extension();
    //     $request->img_1->move(public_path('images'),$newImgname_1);
    //     $newImgname_2= $filename_2. '.' . $request->img_2->extension();
    //     $request->img_2->move(public_path('images'),$newImgname_2);
    //     $newImgname_3= $filename_3. '.' . $request->img_3->extension();
    //     $request->img_3->move(public_path('images'),$newImgname_3);
    //     $newImgname_4=$filename_4. '.' . $request->img_4->extension();
    //     $request->img_4->move(public_path('images'),$newImgname_4);
    //     $newImgname_5=$filename_5. '.' . $request->img_5->extension();
    //     $request->img_5->move(public_path('images'),$newImgname_5);
    //     password::create([
    //             'username' => $request->username,
    //             'email' => $request->email,
    //             'address' => $request->address,
    //             'city' => $request->city,
    //             'contact_num' => $request->contact,
    //             'img' => $newImgname_1,
    //     ]);
    //     password::create([
    //             'username' => $request->username,
    //             'email' => $request->email,
    //             'address' => $request->address,
    //             'city' => $request->city,
    //             'contact_num' => $request->contact,
    //             'img' => $newImgname_2,
    //     ]);
    //     password::create([
    //             'username' => $request->username,
    //             'email' => $request->email,
    //             'address' => $request->address,
    //             'city' => $request->city,
    //             'contact_num' => $request->contact,
    //             'img' => $newImgname_3,
    //     ]);
    //     password::create([
    //             'username' => $request->username,
    //             'email' => $request->email,
    //             'address' => $request->address,
    //             'city' => $request->city,
    //             'contact_num' => $request->contact,
    //             'img' => $newImgname_4,
    //     ]);
    //     password::create([
    //             'username' => $request->username,
    //             'email' => $request->email,
    //             'address' => $request->address,
    //             'city' => $request->city,
    //             'contact_num' => $request->contact,
    //             'img' => $newImgname_5,
    //     ]);
    //     return view('password.index');

    //     }else{
    //         return response()->json([
    //             'message'=>'user exists',
    //         ]);
    //     }

    // }


    public function store_user(Request $request)
    {

        $allusers = password::orderBy('updated_at', 'DESC')->get();




        // $check_str=$filename_1.$filename_2.$filename_3.$filename_4.$filename_5;
        // if (substr_count($check_str,$filename_1)>1) {
        //     return back()->with(['message'=>'same images not allowed']);
        // }
        // if (substr_count($check_str,$filename_2)>1) {
        //     return back()->with(['message'=>'same images not allowed']);
        // }
        // if (substr_count($check_str,$filename_3)>1) {
        //     return back()->with(['message'=>'same images not allowed']);
        // }
        // if (substr_count($check_str,$filename_4)>1) {
        //     return back()->with(['message'=>'same images not allowed']);
        // }
        // if (substr_count($check_str,$filename_5)>1) {
        //     return back()->with(['message'=>'same images not allowed']);
        // }

        // $newImgname_1= $filename_1. '.' . $request->img_1->extension();
        // $request->img_1->move(public_path('images'),$newImgname_1);
        // $newImgname_2= $filename_2. '.' . $request->img_2->extension();
        // $request->img_2->move(public_path('images'),$newImgname_2);
        // $newImgname_3= $filename_3. '.' . $request->img_3->extension();
        // $request->img_3->move(public_path('images'),$newImgname_3);
        // $newImgname_4=$filename_4. '.' . $request->img_4->extension();
        // $request->img_4->move(public_path('images'),$newImgname_4);
        // $newImgname_5=$filename_5. '.' . $request->img_5->extension();
        // $request->img_5->move(public_path('images'),$newImgname_5);

        password::create([
            'username' => $request->username,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'contact_num' => $request->contact_num,
            'img' => $request->img,
        ]);

        return view('select')->with([
            'username' => $request->username,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'contact_num' => $request->contact,
            'users' => $allusers
        ]);
    }
}
