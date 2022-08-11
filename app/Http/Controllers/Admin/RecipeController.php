<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRecipeRequest;
use App\Http\Resources\Admin\RecipeResource;
use App\Models\Category;
use App\Models\Recipe;

class RecipeController extends Controller
{
    public function index()
    {

//        $recipes = RecipeResource::collection(Recipe::all());
        $recipes = RecipeResource::collection(Recipe::with('category')->get());

        return inertia('Admin/Recipes/Index', compact('recipes'));
    }

    public function create()
    {
        return inertia('Admin/Recipes/Create', ['categories' => Category::all()]);
    }

    public function store(StoreRecipeRequest $request)
    {

        if($request->hasFile('photo_path')) {
            $request->validated();

            $attributes = $request->except('photo_path');
            $attributes['photo_path'] = $request->file('photo_path')
                ->store('images', 'public');
            Recipe::create($attributes);
        }
        else {
            Recipe::create($request->validated());
        }


//        Recipe::create([
//            'title' => $request->title,
//            'total_time' => $request->total_time,
//            'ingredients' => $request->ingredients,
//            'instructions' => $request->instructions
//        ]);

        return redirect()->route('admin.recipes.index')
            ->with('message', 'Recipe created successfully');
    }

    public function destroy(Recipe $recipe)
    {
        $recipe->delete();

        return redirect()->route('admin.recipes.index')
            ->with('message', 'Recipe deleted successfully');
    }

    public function edit(Recipe $recipe)
    {
//        $recipe = new RecipeResource($recipe);

        return inertia('Admin/Recipes/Edit', [
            'categories' => Category::all(),
            'recipe' => $recipe
            ]);
    }

    public function update(Recipe $recipe, StoreRecipeRequest $request)
    {
//        $recipe = Recipe::with('category');
        $recipe->update($request->validated());

        return redirect()->route('admin.recipes.index')
            ->with('message', 'Recipe updated successfully');
    }

}
