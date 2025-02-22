<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Login;
use App\Models\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    public function login(Login $request)
    {

        // $credentials = [
        //     'email'=> $request->email,
        //     'password' => $request->password
        // ];

        $admin = Admin::where('email', $request->email)->orWhere('username', $request->email)->first();


        if ($admin && Auth::attempt(['email' => $admin->email, 'password' => $request->password])) {
            $request->session()->regenerate();
        } else {
            throw ValidationException::withMessages([
                'email' => 'اسم المستخدم او كلمة المرور خاطئين'
            ]);
        }


        return $admin;
    }

    public function user(Request $request)
    {
        return $request->user();
    }
}
