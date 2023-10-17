<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'category_name' => 'required|max:255',
        'category_description' => 'nullable',
    ]);

    Category::create($request->all());

    return redirect()->route('categories.index')->with('success', 'Category created successfully');
}

}
