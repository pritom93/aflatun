<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class AuthController extends Controller
{
    public function logInUsers()
    {
        // Auth::logout();
        return view('font.user.users_login');
    }
    public function loginRequest(Request $request)
    {
        try {
          
            // $user = User::where('email', $request->email)->first();
            $array = ['email' => $request->email, 'password' => $request->password];
            

            if (Auth::attempt($array,true)) {                            
                $user = Auth::user();

                return response()->json([
                    'success' => true,
                    'message' => 'Login successful',
                    'user' => $user
                ], 200);
            }


        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred',
                'error' => $th->getMessage()
            ], 500);
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Logout successful');
    }
}
