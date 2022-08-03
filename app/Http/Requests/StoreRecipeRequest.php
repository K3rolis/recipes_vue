<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecipeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required',
//            'category_id' => 'required|exists:categories,id',
            'total_time' => 'required|integer|numeric|min:1|max:10080',
            'ingredients' => 'required',
            'instructions' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Please enter a title',
//            'category_id.required' => 'Please enter a category',
//            'category_id.exists' => 'This category does not exists',
            'total_time.required' => 'Please enter a time',
            'total_time.integer' => 'Please enter valid integer value',
            'total_time.numeric' => 'Please enter valid integer value',
            'total_time.min' => 'Please enter a valid time',
            'total_time.max' => 'Too much time for this recipe',
            'ingredients.required' => 'Please enter ingredients',
            'instructions.required' => 'Please enter instructions'
        ];
    }
}
