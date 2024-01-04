<?php

namespace App\Http\Controllers;

use App\Models\societies;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(Request $request)
    {
        $user = societies::where('id_card_number', $request->input('id_card_number'))->where('password', $request->input('password'))->with('regional')->first();

        if ($user) {
            $login_tokens = md5($request->password);
            $user->update(['login_tokens' => $login_tokens]);
            return Controller::success('Login Success', $user, 200);
        }

        return Controller::failed('Login Failed', 401);
    }

    public function logout(Request $request)
    {
        $check = societies::where('login_tokens', $request->query('login_tokens'))->first();
        if ($check) {
            $check->update(['login_tokens' => null]);
            return Controller::success('Logout Successfully', $check, 200);
        } else {
            return Controller::failed('Invalid Token', 401);
        }
    }
}
