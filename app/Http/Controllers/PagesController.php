<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    //home
    public function home()
    {
        $products = Product::with('category', 'colors',)->orderBy('created_at', 'desc')->get();
        return view('pages.home', ['products' => $products]);
    }

    //cart
    public function cart()
    {
        return view('pages.cart');
    }

    public function success()
    {
        return "Successfully Done";
    }

    public function wishlist()
{
    if (Auth::check()) {
        $products = Auth::user()->wishlist;
        return view('pages.wishlist', ['products' => $products]);
    }

    // Handle the case where the user is not authenticated
    return redirect()->route('login');
}


    public function account()
    {
        return view('pages.account');
    }

    public function checkout()
    {
        return view('pages.checkout');
    }

    public function product($id)
    {
        $product = Product::with('category', 'colors')->findOrFail($id);
        return view('pages.product', ['product' => $product]);
    }

    public function laundry()
    {
        return view('pages.laundry');
    }

}
