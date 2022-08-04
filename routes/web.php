<?php

use Illuminate\Foundation\Application;
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

//Route::get('recipes', [\App\Http\Controllers\RecipeController::class, 'index'])->name('recipes.index');
Route::resource('recipes', \App\Http\Controllers\RecipeController::class);

//Route::resource('categories', \App\Http\Controllers\CategoryController::class);
Route::get('categories', [\App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
Route::delete('categories/{category}', [\App\Http\Controllers\CategoryController::class, 'destroy'])->name('categories.destroy');
Route::post('categories/{}', [\App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');

//Route::resource('comments', \App\Http\Controllers\CommentController::class);
Route::get('comments', [\App\Http\Controllers\CommentController::class, 'index'])->name('comments.index');
Route::get('comments/edit/{comment}', [\App\Http\Controllers\CommentController::class, 'edit'])->name('comments.edit');
Route::patch('comments/edit/{comment}', [\App\Http\Controllers\CommentController::class, 'update'])->name('comments.update');
Route::delete('comments/{comment}', [\App\Http\Controllers\CommentController::class, 'destroy'])->name('comments.destroy');

require __DIR__.'/auth.php';
