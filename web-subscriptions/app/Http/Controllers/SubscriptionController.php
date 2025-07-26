<?php

namespace App\Http\Controllers;

use App\Models\Website;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{

    // api to subscribe users on a specific website
    public function subscribeUser(Request $request, Website $website)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::find($request->user_id);

        // Prevent duplicate subscription
        if ($user->websites()->where('website_id', $website->id)->exists()) {
            return response()->json([
                'message' => 'User already subscribed to this website.'
            ], 409);
        }

       $user->websites()->attach(id: $website->id);

        return response()->json([
            'message' => 'User subscribed successfully.'
        ], 201);
        }
     

}