<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
//use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = CategoryResource::collection(Category::all());

        return inertia('Categories/Index', compact('categories'));
    }

    public function store(StoreCategoryRequest $request)
    {
        Category::create($request->validated());

        return redirect()->route('categories.index')
            ->with('message', 'Category created successfully');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')
            ->with('message', 'Category deleted successfully');
    }
}
