<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Http\Requests\StoreRecipeRequest;
use App\Http\Resources\RecipeResource;
use App\Models\Recipe;

class RecipeController extends Controller
{
    public function index()
    {
//        sleep(1);
        $recipes = RecipeResource::collection(Recipe::all());

        return inertia('Recipes/Index', compact('recipes'));
    }

    public function create()
    {
        return inertia('Recipes/Create');
    }

    public function store(StoreRecipeRequest $request)
    {
        Recipe::create($request->validated());

//        Recipe::create([
//            'title' => $request->title,
//            'total_time' => $request->total_time,
//            'ingredients' => $request->ingredients,
//            'instructions' => $request->instructions
//        ]);

        return redirect()->route('recipes.index')
            ->with('message', 'Recipe created successfully');
    }

    public function destroy(Recipe $recipe)
    {
        $recipe->delete();

        return redirect()->route('recipes.index')
            ->with('message', 'Recipe deleted successfully');
    }

    public function edit(Recipe $recipe)
    {
//        $recipe = new RecipeResource($recipe);

        return inertia('Recipes/Edit', compact('recipe'));
    }

    public function update(Recipe $recipe, StoreRecipeRequest $request)
    {
        $recipe->update($request->validated());

        return redirect()->route('recipes.index')
            ->with('message', 'Recipe updated successfully');
    }

}
