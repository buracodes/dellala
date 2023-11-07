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
            } else {
                $request->request->remove('password'); 
            }
    
            $updated = User::findOrFail($id);
    
            $fillableData = $request->only(['name', 'email', 'password', 'avatar']);
    
            // if the password feild is not provided remove it from the fillable data
            if (empty($fillableData['password'])) {
                unset($fillableData['password']);
            }
    
            $updated->fill($fillableData);
            $updated->save();
    
            $response = $updated->toArray();
            unset($response['password']);
    
            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    
    public function delete($id)
    {
        $user = Auth::user();
        
        if ($user->id !== intval($id)) {
            return response()->json(['error' => 'You can only update your own account!'], 401);
        }
        
        try {
            $user = User::find($id);
            $user->delete();
            return response()->json(['message' => 'User has been deleted!'], 200)
                             ->withCookie(Cookie::forget('access_token'));
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