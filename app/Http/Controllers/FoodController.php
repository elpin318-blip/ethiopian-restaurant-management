<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Category;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function index()
    {
        $foods = Food::with('category')->get();
        return view('foods.index', compact('foods'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('foods.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required'
        ]);

        Food::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'is_spicy' => $request->has('is_spicy'),
            'is_vegetarian' => $request->has('is_vegetarian'),
            'is_available' => true
        ]);

        return redirect('/admin/foods')->with('success', 'Food added!');
    }

    public function edit($id)
    {
        $food = Food::findOrFail($id);
        $categories = Category::all();
        return view('foods.edit', compact('food', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $food = Food::findOrFail($id);
        
        $food->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'is_spicy' => $request->has('is_spicy'),
            'is_vegetarian' => $request->has('is_vegetarian')
        ]);

        return redirect('/admin/foods')->with('success', 'Food updated!');
    }

    public function destroy($id)
    {
        $food = Food::findOrFail($id);
        $food->delete();
        return redirect('/admin/foods')->with('success', 'Food deleted!');
    }
    public function updateStock(Request $request, $id)
{
    $food = Food::findOrFail($id);
    $food->stock = $request->stock;
    $food->save();
    
    return redirect()->back()->with('success', 'Stock updated!');
}
}