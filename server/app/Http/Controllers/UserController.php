<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Firebase\JWT\JWT;
use Exception;



class UserController extends Controller
{
    public function update(Request $request, $id)
    {
        try {
            $user = Auth::user();
    
            if ($user->id !== intval($id)) {
                return response()->json(['error' => 'You can only update your own account!'], 401);
            }
    
            if ($request->filled('password')) {
                $request->merge(['password' => Hash::make($request->password)]);
            }
    
            $updated = User::findOrFail($id);
    
            $updated->fill($request->only([
                'name', 'email', 'password', 'avatar'
            ]));
    
            $updated->save();
    
            $response = $updated->toArray();
            unset($response['password']);
    
            return response()->json($response);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}