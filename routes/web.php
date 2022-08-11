<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register')
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//ADMIN

//Route::resource('recipes', \App\Http\Controllers\Admin\RecipeController::class);

Route::get('admin/recipes', [\App\Http\Controllers\Admin\RecipeController::class, 'index'])->name('admin.recipes.index');
Route::get('admin/recipes/create', [\App\Http\Controllers\Admin\RecipeController::class, 'create'])->name('admin.recipes.create');
Route::get('admin/recipes/edit/{recipe}', [\App\Http\Controllers\Admin\RecipeController::class, 'edit'])->name('admin.recipes.edit');
Route::put('admin/recipes/{recipe}', [\App\Http\Controllers\Admin\RecipeController::class, 'update'])->name('admin.recipes.update');
Route::post('admin/recipes', [\App\Http\Controllers\Admin\RecipeController::class, 'store'])->name('admin.recipes.store');
Route::delete('admin/recipes/{recipe}', [\App\Http\Controllers\Admin\RecipeController::class, 'destroy'])->name('admin.recipes.destroy');


//Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
Route::get('admin/categories', [\App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.categories.index');
Route::delete('admin/categories/{category}', [\App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('admin.categories.destroy');
Route::post('admin/categories/{}', [\App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('admin.categories.store');

//Route::resource('comments', \App\Http\Controllers\Admin\CommentController::class);
Route::get('admin/comments', [\App\Http\Controllers\Admin\CommentController::class, 'index'])->name('admin.comments.index');
Route::get('admin/comments/edit/{comment}', [\App\Http\Controllers\Admin\CommentController::class, 'edit'])->name('admin.comments.edit');
Route::patch('admin/comments/edit/{comment}', [\App\Http\Controllers\Admin\CommentController::class, 'update'])->name('admin.comments.update');
Route::delete('admin/comments/{comment}', [\App\Http\Controllers\Admin\CommentController::class, 'destroy'])->name('admin.comments.destroy');

//USER

Route::get('', [\App\Http\Controllers\RecipeController::class, 'index'])->name('recipes.index');
Route::get('recipe/{recipe}', [\App\Http\Controllers\RecipeController::class, 'show'])->name('recipe.show');

Route::post('', [\App\Http\Controllers\CommentController::class, 'store'])->name('comment.store');
Route::get('comments/edit/{comment}', [\App\Http\Controllers\CommentController::class, 'edit'])->name('comment.edit');
Route::patch('comments/edit/{comment}', [\App\Http\Controllers\CommentController::class, 'update'])->name('comment.update');
Route::delete('comments/{comment}', [\App\Http\Controllers\CommentController::class, 'destroy'])->name('comment.destroy');


require __DIR__.'/auth.php';
