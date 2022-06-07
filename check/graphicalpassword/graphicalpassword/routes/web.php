<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\NewuserController;
use \App\Http\Controllers\PasswordCheckController;
use \App\Http\Controllers\PasswordController;
use App\Models\admin_login;
use App\Models\newuser;
use App\Models\password;
use App\Models\password_check;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
////////////////////////////////////login sign up or users//////////////////////////////////
// Route::get('/', function () {

//     return view('password.welcome');



// })->name('password.welcome')->middleware('access');

Route::get("/", [PasswordCheckController::class, "validation"])->name('password.welcome')->middleware('access');
Route::get('/admin/signup', function () {
    return view('password.signup');
})->name('signup.admin')->middleware('access');




Route::get('/forget', function () {
    return view('password.forget');
});



///////////////////////////////////////users routes////////////////////////////////////////////////////
Route::get('/password_select', [PasswordController::class, 'select_pass_validated'])->name('password.image');
Route::post('/password_select', [PasswordController::class, 'select_pass_validated'])->name('password.image');
Route::get('/password/reset', [PasswordController::class, 'reset_password'])->name('reset_user.password');
Route::get('/forgot_pass', [PasswordController::class, 'forgot_password'])->name('forgot_pass.user');
Route::post('/select_password', [PasswordController::class, 'select_password'])->middleware('access');
Route::get('/select_password/reset', [PasswordController::class, 'select_email_password'])->name('select.password');
Route::get('passwords/show', [PasswordController::class, 'index'])->name('passwords.show');
route::get('/newuser', [NewuserController::class, 'store'])->name('newuser.store_user');
Route::get('password_checks', [PasswordCheckController::class, 'store'])->name('password_checks.store');
Route::get('passwords', [PasswordController::class, 'login_page'])->name('login.passwords');
Route::post('passwords/check', [PasswordController::class, 'password_check'])->name('passwords.check');
Route::get('passwords/store_user', [PasswordController::class, 'store_user'])->name('password.store_user');


Route::get('/admin_roles', [AdminController::class, 'roles'])->middleware('access');

/////////////////////////////////////////////butttons////////////////////////////////////////////////////
Route::get('/selection/reset', function () {

    password::orderBy('updated_at', 'DESC')->update([
        'selected_image' => '0',
    ]);
    $username = session('signedup_user');
    $new_users = newuser::where('username', $username);
    $admin_logins = admin_login::where('username', $username);
    if ($new_users) {
        $new_users->delete();
    }
    return redirect()->route('password.image', [
        'username' => session('signedup_user'),
        'email' => session('email'),
        'address' => session('address'),
        'city' => session('city'),
        'contact_num' => session('contact_num'),
        'submit_button' => 'off'
    ]);
});
Route::get('/submit/selection', function (Request $request) {
    password::orderBy('updated_at', 'DESC')->update([
        'selected_image' => '0',
    ]);
    $user=newuser::where('username',$request->username)->first();
    return view('user.welcome', [
        'username' => $user->username,
        'email' => $user->email,
        'address' => $user->address,
        'city' => $user->city,
        'contact_num' => $user->contact_num,
        'message' => 'login successfull'
    ]);
})->name('submit.selection');



/////////////////////////////////////////roles routes//////////////////////////////////////////////////////

////////////////////////////////////////users routes///////////////////////////////////////////////////////

Route::get('/redirect',function(Request $request){
    
$user=newuser::where('username',$request->username)->first();
    return redirect()->route('user.reset')->with([
        'username' => $request->username,
        'email' => $user->email,
        'address' => $user->address,
        'city' => $user->city,
        'contact_num' => $user->contact_num,
        'deluser'=>'1'
    ]);
})->name('redirect.user');
Route::get('/user/reset',[PasswordController::class,'select_reset_password'])->name('user.reset');




Route::group(['middleware' => 'preventCache'], function () {


    //////////////////////////////////admin routes////////////////////////////////////////////////////////////
    Route::post('/admin_validation', [AdminController::class, 'check']);
    Route::get('/admin/logins', [AdminController::class, 'logins'])->name('admin.logins');
    Route::get('/admin/failed', [AdminController::class, 'failed'])->name('admin.failed');
    Route::get('/admin/resets', [AdminController::class, 'resets']);
    Route::get('/admin/unlock',[AdminController::class,'unlock'])->name('admin.unlock');

    //////////////////////////////////employee routes////////////////////////////////////////////////////////////


    Route::get('/employee/users', [EmployeeController::class, 'users'])->name('employee.users');
    Route::get('/employee/images', [EmployeeController::class, 'images'])->name('employee.images');
    Route::delete('/employee/delete', [EmployeeController::class, 'destroy'])->name('delete.user');
    Route::post('/employee.add', [EmployeeController::class, 'add_image'])->name('employee.add');
});









////////////////////////////////////logout routes////////////////////////////////////////////////////////////

Route::get('/logout', function () {

    if (session()->has('password_user')) {
        password::orderBy('updated_at', 'DESC')->update([
            'selected_image' => '0',
        ]);
        session()->pull('password_user');
        return redirect()->route('password.welcome');
    }
    if (session()->has('username')) {
        session()->pull('username');
        return redirect()->route('password.welcome');
    }
});


Route::get('/rejected_user', function () {
    if (session()->has('signedup_user')) {

        $username = session('signedup_user');
        $new_users = newuser::where('username', $username);
        $admin_logins = admin_login::where('username', $username);
        if ($new_users) {
            $new_users->delete();
        }
        if ($admin_logins) {
            $admin_logins->delete();
        }
        session()->pull('signedup_user');
        return redirect()->route('signup.admin');
    }
});



Route::get('/signout_user', function () {
    if (session()->has('signedup_user')) {
        session()->pull('signedup_user');
        return redirect()->route('signup.admin');
    }
});


///////////////////////////////////////////////////////////////////
Route::get('/user_login',function(){
    return view('user.welcome');
});