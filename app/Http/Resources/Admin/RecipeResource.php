<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class RecipeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'photo_path' => $this->photo_path,
            'total_time' => $this->total_time,
            'ingredients' => substr($this->ingredients,0, 50) . '...',
            'instructions' => substr($this->instructions, 0, 50) . '...',
            'created_at' => $this->created_at->diffForHumans(),
            'category_id' => $this->category_id,
            'recipe_url' => env('APP_URL') . '/storage/' . $this->photo_path
        ];
    }
}
