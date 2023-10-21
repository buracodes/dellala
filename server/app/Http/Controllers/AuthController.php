<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Hash;

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
}
