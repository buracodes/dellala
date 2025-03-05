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


    public function showListings(Request $request, $id)
    {
    $user = User::find($id); // Use find() to look up the user by ID.

    if ($user) {
        if ($user->id === $request->user()->id) {
            try {
                $listings = Listing::where('userRef', $id)->get();
                return response()->json($listings, 200);
            } catch (\Exception $error) {
                return response()->json(['error' => $error->getMessage()], 500);
            }
        } else {
            return response()->json(['error' => 'You can only view your own listings!'], 401);
        }
    } else {
        return response()->json(['error' => 'User not found.'], 404);
    }
}

public function deleteListing(Request $request, $id)
    {
        try {
            $listing = Listing::find($id);

            if (!$listing) {
                return response()->json(['error' => 'Listing not found!'], 404);
            }

            if ($request->user()->id !== $listing->userRef) {
                return response()->json(['error' => 'You can only delete your own listings!'], 401);
            }

            $listing->delete();
            return response()->json(['message' => 'Listing has been deleted!'], 200);
        } catch (\Exception $error) {
            return response()->json(['error' => $error->getMessage()], 500);
        }
    }

    public function updateListing(Request $request, $id)
{
    try {
        $listing = Listing::find($id);

        if (!$listing) {
            return response()->json(['error' => 'Listing not found!'], 404);
        }

        if ($request->user()->id !== $listing->userRef) {
            return response()->json(['error' => 'You can only update your own listings!'], 401);
        }

        $listing->update($request->all()); // update the request 

        if (!$listing->save()) {
            return response()->json(['error' => 'Failed to update listing.'], 400);
        }

        // fetch the updated listing after the update
        $updatedListing = Listing::find($id);

        return response()->json($updatedListing, 200);
    } catch (\Exception $error) {
        return response()->json(['error' => $error->getMessage()], 500);
    }
}

public function getListing(Request $request, $id)
    {
        try {
            $listing = Listing::find($id);

            if (!$listing) {
                return response()->json(['error' => 'Listing not found!'], 404);
            }

            return response()->json($listing, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function getUser($id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'statusCode' => 404,
                    'message' => 'User not found!',
                ], 404);
            }

            // Remove sensitive data (e.g., password) from the response
            $rest = $user->toArray();
            unset($rest['password']);

            return response()->json([
                'success' => true,
                'statusCode' => 200,
                'data' => $rest,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'statusCode' => 500,
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    public function searchListings(Request $request)
{
    try {
        $limit = $request->query('limit', 9);
        $startIndex = $request->query('startIndex', 0);
        $offer = $request->query('offer', null);

        if ($offer === null || $offer === 'false') {
            $offer = [false, true];
        } else {
            $offer = explode(',', $offer); // Convert to array
        }

        $furnished = $request->query('furnished', null);

        if ($furnished === null || $furnished === 'false') {
            $furnished = [false, true];
        } else {
            $furnished = explode(',', $furnished); // Convert to array
        }

        $parking = $request->query('parking', null);

        if ($parking === null || $parking === 'false') {
            $parking = [false, true];
        } else {
            $parking = explode(',', $parking); // Convert to array
        }

        $type = $request->query('type', null);

        if ($type === null || $type === 'all') {
            $type = ['sale', 'rent'];
        } else {
            $type = explode(',', $type); // Convert to array
        }

        $searchTerm = $request->query('searchTerm', '');
        $sort = $request->query('sort', 'created_At');
        $order = $request->query('order', 'desc');

        $listings = Listing::query()
            ->where('name', 'like', '%' . $searchTerm . '%')
            ->whereIn('offer', $offer)
            ->whereIn('furnished', $furnished)
            ->whereIn('parking', $parking)
            ->whereIn('type', $type)
            ->orderBy($sort, $order)
            ->limit($limit)
            ->offset($startIndex)
            ->get();

        return response()->json($listings, 200);
    } catch (\Exception $e) {
        return response()->json(['message' => $e->getMessage()], 500);
    }
}

}
