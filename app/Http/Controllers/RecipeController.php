<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\StoreRecipeRequest;
use App\Http\Resources\Admin\CommentResource;
use App\Http\Resources\Admin\RecipeResource;
use App\Http\Resources\UserResource;
use App\Models\Comment;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = RecipeResource::collection(Recipe::all());

        return inertia('Welcome', compact('recipes'));
    }

    public function show(Recipe $recipe)
    {
        return inertia('Recipes/Show',[
            'comments' => CommentResource::collection(Comment::all()),
            'recipe' => $recipe,
        ]);
    }

}
