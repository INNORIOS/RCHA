<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class categoryController extends Controller
{
    public function store(Request $request)
{
    
    $request->validate([
        'category_name' => 'required|max:255',
        'category_description' => 'nullable',
    ]);
    try{
    $category=Category::create($request->all());
    return response()->json($category,201);
    }catch(\Exception $e){
        Log::error($e->getMessage());
        return response()->json(['message' => 'An error occurred while creating the category.'], 500);
    }
}
public function listCategories()
{
    try {
        $categories = Category::all();
        return response()->json($categories);
    } catch (\Exception $e) {
        Log::error($e->getMessage());
        return response()->json(['message' => 'An error occurred while fetching categories.'], 500);
    }
}

}
