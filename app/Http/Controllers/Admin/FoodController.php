<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoodController extends Controller
{
    public function index()
    {
        $foods = Food::with('category')->get();
        return view('admin.foods.index', compact('foods'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.foods.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $food = Food::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'is_spicy' => $request->has('is_spicy'),
            'is_vegetarian' => $request->has('is_vegetarian'),
            'is_available' => true,
            'stock' => 50
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('foods', 'public');
            $food->image = $imagePath;
            $food->save();
        }

        // FIXED: Use direct URL instead of named route
        return redirect('/admin/foods')->with('success', 'Food added successfully!');
    }

    public function edit($id)
    {
        $food = Food::findOrFail($id);
        $categories = Category::all();
        return view('admin.foods.edit', compact('food', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $food = Food::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $food->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'is_spicy' => $request->has('is_spicy'),
            'is_vegetarian' => $request->has('is_vegetarian')
        ]);

        if ($request->hasFile('image')) {
            if ($food->image && Storage::disk('public')->exists($food->image)) {
                Storage::disk('public')->delete($food->image);
            }
            $imagePath = $request->file('image')->store('foods', 'public');
            $food->image = $imagePath;
            $food->save();
        }

        // FIXED: Use direct URL instead of named route
        return redirect('/admin/foods')->with('success', 'Food updated successfully!');
    }

    public function destroy($id)
    {
        $food = Food::findOrFail($id);
        if ($food->image && Storage::disk('public')->exists($food->image)) {
            Storage::disk('public')->delete($food->image);
        }
        $food->delete();
        
        // FIXED: Use direct URL instead of named route
        return redirect('/admin/foods')->with('success', 'Food deleted successfully!');
    }

    public function updateStock(Request $request, $id)
    {
        $food = Food::findOrFail($id);
        $food->stock = $request->stock;
        $food->save();
        
        return redirect()->back()->with('success', 'Stock updated successfully!');
    }

    public function toggleAvailability($id)
    {
        $food = Food::findOrFail($id);
        $food->is_available = !$food->is_available;
        $food->save();
        
        return response()->json(['success' => true, 'available' => $food->is_available]);
    }
}