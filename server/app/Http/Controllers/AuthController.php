<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Firebase\JWT\JWT;
use Validator;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        
    $val = $request->validate([
        'name' => 'required|unique:users',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
    ], [
        'name.required' => 'User name is required.',
        'email.required' => 'Email is required.',
        'email.email' => 'Please enter a valid email address.',
        'email.unique' => 'Email is already registered.',
        'name.unique' => 'Username is taken.',
        'password.required' => 'Password is required.',
        'password.min' => 'The password must be at least 6 characters.',
    ]);

        $name = $val['name'];
        $email = $val['email'];
        $password = $val['password'];

        $hpw= Hash::make($password);

        try {
            $user = new User();
            $user->name = $name;
            $user->email = $email;
            $user->password = $hpw;
            $user->save();

            return response()->json('User created successfully!', 201);
        } catch (error) {
            return response()->json(error->getMessage(), 500);
        }
    }

    
 
public function signin(Request $request)
{
    try{

    $valid =  $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6',
    ], [
        'email.required' => 'Email is required.',
        'email.email' => 'Please enter a valid email address.',
        'password.required' => 'Password is required.',
        'password.min' => 'Password must be at least 6 characters.',
    ]);

    $user = User::where('email', $request->input('email'))->first();

    if (!$user) {
        return response()->json(['success' => false, 'error' => 'User not found'], 404);
    }
   
if (!Hash::check($request->input('password'), $user->password)) {
    return response()->json(['success' => false, 'error' => "Password is not correct"], 401);
}

    $token = JWTAuth::fromUser($user);

    $response = response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'access_token' => $token
    ]);

    // Set a cookie named 'access_token' with the JWT token as the value and a 60-minute expiration time
    $response->cookie('access_token', $token, 60);

    return $response;
}catch (\Exception $error) {
    return response()->json(['error' => $error->getMessage()], 500);
}
}

public function google(Request $request)
{
    try {
        $user = User::where('email', $request->input('email'))->first();

        if ($user) {
            $token = JWTAuth::fromUser($user);
            $rest = collect($user)->except('password')->toArray();

            return response()
                ->json($rest)
                ->cookie('access_token', $token, 0, '/', null, false, true); // Set the cookie with the token
        } else {
            $generatedPassword = Str::random(8) . Str::random(8);
            $hashedPassword = Hash::make($generatedPassword);
            $newUser = new User();
            $newUser->name = Str::slug(str_replace(' ', '', $request->input('name')), '') . Str::random(4);
            $newUser->email = $request->input('email');
            $newUser->password = $hashedPassword;
            $newUser->avatar = $request->input('photo');
            $newUser->save();

            $token = JWTAuth::fromUser($newUser);
            $rest = collect($newUser)->except('password')->toArray();

            return response()
            ->json($rest)
            ->cookie('access_token', $token, 0, '/', null, false, true)
            ->header('Content-Type', 'application/json'); // Set the cookie with the token
        }
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
}