<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LaundryRequest;

class LaundryController extends Controller
{

    public function storePickup(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'mobile' => 'required|string',
            'delivery_date' => 'required|date',
        ]);

        // Get the currently authenticated user
        $user = Auth::user();

        // Create a new LaundryRequest associated with the user
        $user->laundryRequests()->create([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'mobile' => $request->input('mobile'),
            'delivery_date' => $request->input('delivery_date'),
            'status' => 'Pending', // Set the initial status
            // Add other fields as needed
        ]);

        return redirect()->route('account')->with('success', 'Pickup request submitted successfully.');
    }

    public function showPickupForm()
    {
        return view('pages.pickup'); // Replace 'pages.pickup' with the actual view path
    }
}
