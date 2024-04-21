<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //adminpanel

    //display products table
    public function index()
    {
        $products = Product::with('category', 'colors')->orderBy('created_at', 'desc')->get();
        return view('admin.pages.products.index', ['products' => $products]);
    }

    //create
    public function create()
    {
        $categories = Category::all();
        $colors = Color::all();
        return view('admin.pages.products.create', ['categories' => $categories, 'colors' => $colors]);
    }


    //edit
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $colors = Color::all();
        return view('admin.pages.products.edit', ['categories' => $categories, 'colors' => $colors, 'product' => $product]);
    }

    public function store(Request $request)
    {
        //validate
        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required',
            'colors' => 'required',
            'price' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);
        //store image
        $image_name = 'products/' . time() . rand(0, 9999) . '.' . $request->image->getClientOriginalExtension();
        $request->image->storeAs('public', $image_name);
        //store
        $product = Product::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'price' => $request->price * 100,
            'description' => $request->description,
            'image' => $image_name
        ]);

        $product->colors()->attach($request->colors);
        //return req
        return back()->with('success', 'Product Saved');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required',
            'colors' => 'required',
            'price' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

        $product = Product::findOrFail($id);

        //store image
        $image_name = $product->image;
        if($request->image)
        {
            $image_name = 'products/' . time() . rand(0, 9999) . '.' . $request->image->getClientOriginalExtension();
            $request->image->storeAs('public', $image_name);
        }
        //store
        $product->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'price' => $request->price * 100,
            'description' => $request->description,
            'image' => $image_name
        ]);

        $product->colors()->sync($request->colors);
        //return req
        return back()->with('success', 'Product Updated');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return back()->with('success', 'Product Deleted');
    }


}
