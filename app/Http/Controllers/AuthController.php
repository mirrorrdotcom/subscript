<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Audit;
use Illuminate\Support\Facades\Auth;
use PharIo\Manifest\AuthorTest;

class AuthController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }

    public function attempt(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            return back()
                ->withErrors([ "error" => "Incorrect email or password." ]);
        }

        Audit::logLogin();

        return redirect()->route("dashboard");
    }

    public function logout()
    {
        Audit::logLogout();

        Auth::logout();
        
        return redirect()->route("auth.login.show");
    }
}
