<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;


class ListingController extends Controller
{
    public function create(Request $request)
    {
        try {
            $listing = Listing::create($request->all());
            return response()->json($listing, 201);
        } catch (\Exception $error) {
            return response()->json(['error' => $error->getMessage()], 500);
        }
    }

    public function getlistings(Request $request, $id)
    {
         $user = User::where('id', $request->input('id'))->first();
    
        if ($user && $id === $id) {
            try {
                $listings = Listing::where('userRef', $id)->get();
                return response()->json($listings, 200);
            } catch (\Exception $error) {
                return response()->json(['error' => $error->getMessage()], 500);
            }
        } else {
            return response()->json(['error' => 'You can only view your own listings!'], 401);
        }
    }
}
