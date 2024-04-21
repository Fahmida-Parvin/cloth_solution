<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ColorController extends Controller
{
    //
    public function index()
    {
        $colors = Color::all();
        return view('admin.pages.colors.index', ['colors' => $colors]);
    }

    public function store(Request $request)
    {
        //validate
        $request->validate([
            'name' => 'required|unique:categories|max:255',
            'code' => 'required|max:255'
        ]);
        //store data
        $color = new color();
        $color->name = $request->name;
        $color->code = $request->code;
        $color->save();
        //return req
        return back()->with('success', 'Color Saved');
    }

    public function destroy($id)
    {
        color::findOrFail($id)->delete();
        return back()->with('success', 'Color Deleted');
    }

}