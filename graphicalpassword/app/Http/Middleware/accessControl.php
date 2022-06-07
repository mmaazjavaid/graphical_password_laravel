<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;

class accessControl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('signedup_user')) {

            return redirect()->route('password.image', [
                'username' => session('signedup_user'),
                'email' => session('email'),
                'address' => session('address'),
                'city' => session('city'),
                'contact_num' => session('contact_num'),
                'submit_button' => 'off'
            ]);
        }
        if (session()->has('password_user')) {
            $data = session('password_user');
            return redirect()->route('passwords.show', [
                'username' => $data
            ]);
        }
        if (session()->has('username')) {
            if (session('username') == 'graphicaladmin') {
                return redirect()->route('admin.logins');
            }
            if (session('username') == 'graphicalemployee') {
                return redirect()->route('employee.users');
            }
        } else {
            return $next($request);
        }
    }
}
