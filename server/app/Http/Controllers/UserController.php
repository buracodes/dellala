<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
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
        } catch (\Exception $error) {
            return response()->json(['error' => $error->getMessage()], 500);
        }
    }
 

    public function delete($id)
    {
        try {
            $user = Auth::user();
    
            if ($user->id !== intval($id)) {
                return response()->json(['error' => 'You can only delete your own account!'], 401);
            }
    
            $deleted = User::findOrFail($id);
            $deleted->delete();
    
            return response()->json(['message' => 'User has been deleted!'], 200);
        } catch (\Exception $error) {
            return response()->json(['error' => $error->getMessage()], 500);
        }
    }

    public function signOut(Request $request)
    {
        try {
            $response = response()->json(['message' => 'User has been logged out!'], 200);
            $response->cookie('access_token', '', 0);
            return $response;
        } catch (\Exception $error) {
            return response()->json(['error' => $error->getMessage()], 500);
        }
    }
}