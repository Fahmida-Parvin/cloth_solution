<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaundryRequest;

class AdminController extends Controller
{
    //Dashboard

    public function dashboard()
    {
        $pickupRequests = LaundryRequest::all();
        return view('admin.pages.dashboard', compact('pickupRequests'));
    }

    public function viewOrder($id)
    {
        $pickupRequest = LaundryRequest::findOrFail($id);
        return view('admin.pages.viewOrder', compact('pickupRequest'));
    }

    public function updateOrderStatus(Request $request, $id)
{
    $pickupRequest = LaundryRequest::findOrFail($id);

    // Validate the request
    $request->validate([
        'status' => 'required|in:pending,picked up,ready,delivered,',
    ]);

    // Update the status
    $pickupRequest->update([
        'status' => $request->status,
    ]);

    // Redirect back to the order view
    return redirect()->route('admin.viewOrder', $id)->with('success', 'Order status updated successfully.');
}
}
