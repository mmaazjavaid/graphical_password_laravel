<?php

namespace App\Http\Controllers;

use App\Models\admin_failedlogin;
use App\Models\admin_login;
use App\Models\newuser;
use App\Models\password_check;
use Illuminate\Http\Request;
use App\Models\password;

class PasswordCheckController extends Controller
{
    public function validation()
    {
        return view('password.welcome');
    }
    public function store(Request $request)
    {
        $user = newuser::where('username', $request->username)->get();

        $totalpass = password_check::orderBy('updated_at', 'DESC')->get();
        $count = count($totalpass);
        function str_replace_first($from, $to, $content)
        {
            $from = '/' . preg_quote($from, '/') . '/';

            return preg_replace($from, $to, $content, 1);
        }
        if ($count < 5) {

            $img = password::where('img', $request->img)->first();
            if (($img->selected_image) == '0') {
                password::where('img', $request->img)->update([
                    'selected_image' => '1',
                ]);
                password_check::create([
                    'img' => $request->img,
                ]);
            } else {
                password::where('img', $request->img)->update([
                    'selected_image' => '0',
                ]);
                password_check::where('img', $request->img)->delete();
            }
        }
        $totalpass = password_check::orderBy('updated_at', 'DESC')->get();
        $count = count($totalpass);
        if ($count < 5) {
            return back();
        }
        if ($count == 5) {
            $str = '';
            foreach ($user as $oneuser) {
                $str .= $oneuser->img;
            }
            foreach ($totalpass as $pass) {
                if (str_contains($str, $pass->img)) {
                    $str = str_replace_first($pass->img, ' ', $str);
                    continue;
                } else {
                    $totalpass = password_check::orderBy('updated_at', 'DESC');
                    $incorrect_user_login = newuser::where('username', $request->username)->get();
                    foreach ($incorrect_user_login as $incorrectuserlogin) {
                        $incorrect_user = $incorrectuserlogin->email;
                        $username = $incorrectuserlogin->username;
                        break;
                    }
                    password::orderBy('updated_at', 'DESC')->update([
                        'selected_image' => '0',
                    ]);
                    $admin_failedLogins = admin_login::where('email', $incorrect_user)->first();

                    $already_failed = admin_failedlogin::where('email', $incorrect_user)->first();

                    if ($already_failed) {
                        $t_f_attempts = $already_failed->failed_attempts + 1;
                        $already_failed->update([
                            'failed_attempts' => $t_f_attempts,
                        ]);
                    } else {
                        admin_failedlogin::create([
                            'username' => $admin_failedLogins->username,
                            'email' => $admin_failedLogins->email,
                            'address' => $admin_failedLogins->address,
                            'city' => $admin_failedLogins->city,

                            'contact_num' => $admin_failedLogins->contact_num,
                        ]);
                    }


                    $totalpass->delete();
                    return view('password.incorrect_password')->with([
                        'message' => 'password is incorrect',
                        'incorrect_user' => $incorrect_user,
                        'username' =>  $username
                    ]);
                }
            }
            $totalpass = password_check::orderBy('updated_at', 'DESC');
            password::orderBy('updated_at', 'DESC')->update([
                'selected_image' => '0',
            ]);
            $totalpass->delete();
            $user=newuser::where('username',$request->username)->first();
            return view('user.login_welcome')->with([
                'username' => $user->username,
                'email' => $user->email,
                'address' => $user->address,
                'city' => $user->city,
                'contact_num' => $user->contact_num,
                'deluser'=>'1',
                'message' => 'login successfull'
            ]);
        }
    }
}
