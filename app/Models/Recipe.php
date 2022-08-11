<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Recipe extends Model
{
    use HasFactory;
    protected $appends = ['recipe_url'];
    protected $fillable = ['title', 'photo_path', 'total_time', 'ingredients', 'instructions', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getRecipeUrlAttribute()
    {
        return Storage::url($this->photo_path);
    }

}
