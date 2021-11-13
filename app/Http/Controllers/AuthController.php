<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $Validator = Validator::make($request->all(), [
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);
        if ($Validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation errors',
                'errors' => $Validator->errors()
            ], 422);
        }
        $user = User::where('email', '=', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $data['token'] = $user->createToken('myApp')->accessToken;
                $data['user'] = $user;
                return response()->json([
                    'status' => true,
                    'message' => 'Logged in',
                    'data' => $data
                ], 200);
            }
            return response()->json([
                'status' => false,
                'message' => 'Invalid username or password',
            ], 400);
        }
        return response()->json([
            'status' => false,
            'message' => 'Invalid username or password',
        ], 400);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:6'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $user =  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $user->givePermissionTo('create posts');
        if ($user) {
            $data['token'] = $user->createToken('myApp')->accessToken;
            $data['user'] = $user;
            return response()->json([
                'status' => true,
                'message' => 'Register Success',
                'data' => $data
            ], 200);
        }
        return response()->json([
            'status' => false,
            'message' => 'Error Server',
        ], 500);
    }

    public function logout()
    {
        auth()->user()->tokens()->each(function ($token) {
            $token->delete();
        });

        return response()->json([
            'status' => true,
            'message' => 'Logged Out',
        ]);
    }
}
