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
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
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
