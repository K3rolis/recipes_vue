<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\StoreRecipeRequest;
use App\Http\Resources\Admin\CommentResource;
use App\Http\Resources\Admin\RecipeResource;
use App\Http\Resources\UserResource;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Inertia\Inertia;

class RecipeController extends Controller
{
    public function index()
    {
//        $recipes = RecipeResource::collection(Recipe::all());
//
//        return inertia('Welcome', compact('recipes'));

        return Inertia::render('Welcome', [
            'categories' => Category::all(),
            'recipes' => Recipe::query()
                ->when(request('search'), function ($query) {
                    $query->where('title', 'LIKE', "%" .request('search') . "%");
                })
                ->when(request('category'), function ($query) {
                    $query->where('category_id', request('category'));
                })
                ->orderBy('id', 'desc')
                ->paginate(20)
                ->through(function($recipe) {
                    return [
                        'id' => $recipe->id,
                        'title' => $recipe->title,
                        'photo_path' => $recipe->photo_path,
                        'total_time' => $recipe->total_time,
                        'recipe_url' => env('APP_URL') . '/storage/' . $recipe->photo_path,
                    ];
                })
        ]);

    }

    public function show(Recipe $recipe)
    {
        return inertia('Recipes/Show',[
            'comments' => CommentResource::collection(Comment::all()),
            'recipe' => $recipe,
        ]);
    }

}
