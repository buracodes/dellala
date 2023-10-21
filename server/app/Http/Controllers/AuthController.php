<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Cookie;
use Validator;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        
    $validatedData = $request->validate([
        'name' => 'required|unique:users',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
    ], [
        'name.required' => 'User name is required.',
        'email.required' => 'Email is required.',
        'email.email' => 'Please enter a valid email address.',
        'email.unique' => 'This email is already registered.',
        'name.unique' => 'This name is taken.',
        'password.required' => 'Password is required.',
        'password.min' => 'The password must be at least 6 characters.',
    ]);

        $name = $validatedData['name'];
        $email = $validatedData['email'];
        $password = $validatedData['password'];

        $hashedPassword = Hash::make($password);

        try {
            $user = new User();
            $user->name = $name;
            $user->email = $email;
            $user->password = $hashedPassword;
            $user->save();

            return response()->json('User created successfully!', 201);
        } catch (\Exception $error) {
            return response()->json($error->getMessage(), 500);
        }
    }

    
public function signin(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ], [
        'email.required' => 'Email is required.',
        'email.email' => 'Please enter a valid email address.',
        'password.required' => 'Password is required.',
        'password.min' => 'Password must be at least 6 characters.',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 422);
    }

    $user = User::where('email', $request->input('email'))->first();

    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }

    if (!Hash::check($request->input('password'), $user->password)) {
        return response()->json(['error' => "Password is not correct"], 401);
    }

    $token = JWTAuth::fromUser($user);
    
    $response = response()->json([
        'user' => $user,
        'access_token' => $token
    ]);

    // Set a cookie named 'access_token' with the JWT token as the value and a 60-minute expiration time
    $response->withCookie(Cookie::make('access_token', $token, 60));

    return $response;
}
}