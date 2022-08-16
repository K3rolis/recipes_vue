<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRecipeRequest;
use App\Http\Resources\Admin\CategoryResource;
use App\Http\Resources\Admin\RecipeResource;
use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class RecipeController extends Controller
{
    public function index()
    {
        $this->authorize('view', Recipe::class);
//        $recipes = RecipeResource::collection(Recipe::all());
//
//        return inertia('Admin/Recipes/Index', compact('recipes'));
//        $this->authorize('viewAny', Recipe::class);
        return Inertia::render('Admin/Recipes/Index', [
            'recipes' => Recipe::query()
                ->when(request('search'), function ($query) {
                    $query->where('title', 'LIKE', "%" .request('search') . "%")
                        ->orWhere('id', 'LIKE', "%" .request('search') . "%");
                })
                ->orderBy('id', 'desc')
                ->paginate(10)
                ->through(function($recipe) {
//                    $recipe->load('category');
                    return [
                        'id' => $recipe->id,
                        'title' => $recipe->title,
                        'photo_path' => $recipe->photo_path,
                        'total_time' => $recipe->total_time,
                        'ingredients' => substr($recipe->ingredients,0, 50) . '...',
                        'instructions' => substr($recipe->instructions, 0, 50) . '...',
                        'created_at' => $recipe->created_at->diffForHumans(),
                        'category_id' => $recipe->category_id,
                        'recipe_url' => env('APP_URL') . '/storage/' . $recipe->photo_path,
                        'name' => $recipe->category
                        ];
            })
        ]);
    }

    public function create()
    {
        $this->authorize('create', Recipe::class);

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
        $this->authorize('delete', Recipe::class);

        $recipe->delete();

        return redirect()->route('admin.recipes.index')
            ->with('message', 'Recipe deleted successfully');
    }

    public function edit(Recipe $recipe)
    {
//        $recipe = new RecipeResource($recipe);
        $this->authorize('view', $recipe);


        return inertia('Admin/Recipes/Edit', [
            'categories' => Category::all(),
            'recipe' => $recipe
            ]);
    }

    public function update(Recipe $recipe, StoreRecipeRequest $request)
    {
        $this->authorize('update', Recipe::class);

        $recipe->update($request->validated());

        return redirect()->route('admin.recipes.index')
            ->with('message', 'Recipe updated successfully');
    }

}
