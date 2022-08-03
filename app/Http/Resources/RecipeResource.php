<?php

namespace App\Http\Resources;

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
            'file_path' => $this->photo_path,
//            'total_time' => sprintf( '%02d', intdiv($this->total_time, 60)). ':' . sprintf('%02d',($this->total_time % 60)),
            'total_time' => $this->total_time,
            'ingredients' => substr($this->ingredients,0, 50) . '...',
            'instructions' => substr($this->instructions, 0, 50) . '...',
            'created_at' => $this->created_at->diffForHumans(),
//            'updated_at' => $this->updated_at,
//            'category_name' => $this->category->name,
//            'category_id' => $this->category_id,
        ];
    }
}
