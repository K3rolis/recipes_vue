<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Resources\Admin\CategoryResource;
use App\Models\Category;
use Inertia\Inertia;

//use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Category::class);

        return Inertia::render('Admin/Categories/Index', [
            'categories' => Category::query()
                ->paginate(20)
                ->through(function($category) {
                    return [
                        'id' => $category->id,
                        'name' => $category->name,
                        'created_at'=> $category->created_at->diffForHumans(),
                    ];
                })
        ]);

    }

    public function store(StoreCategoryRequest $request)
    {
        $this->authorize('create', Category::class);
        Category::create($request->validated());

        return redirect()->route('admin.categories.index')
            ->with('message', 'Category created successfully');
    }

    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('message', 'Category deleted successfully');
    }

    public function edit(Category $category)
    {
        $this->authorize('view', $category);

        return inertia('Admin/Categories/Edit', compact('category'));
    }

    public function update(Category $category, StoreCategoryRequest $request)
    {
        $this->authorize('update', Category::class);

        $category->update($request->validated());

        return redirect()->route('admin.categories.index')
            ->with('message', 'Category updated successfully');
    }
}
