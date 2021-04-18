<?php

namespace App\Http\Controllers\UserMember\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserMemberRequest;
use Illuminate\Support\Facades\Auth;
use Throwable;

class LoginController extends Controller
{
    public function index()
    {
        if(Auth::guard('user_member')->check())
        {
            return redirect()->route('user_member.dashboard.index');
        }
        return view('user_member.auth.login');
    }

    public function login(LoginUserMemberRequest $request)
    {

        if (Auth::guard('user_member')->attempt($request->validated())) {
            try {
                return redirect()->route('user_member.dashboard');
            } catch (Throwable $e) {
                report($e);

                return false;
            }
        }
        return redirect()->back();
    }

    public function logout()
    {
        Auth::guard('user_member')->logout();

        return redirect()->route('login_member');
    }
}
