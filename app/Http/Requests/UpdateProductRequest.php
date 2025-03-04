<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => 'sometimes|string|max:255',
            'category_id' => 'sometimes|exists:categories,id',
            'description' => 'sometimes|string',
            'price' => 'sometimes|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Название товара обязательно',
            'category_id.required' => 'Категория обязательна',
            'category_id.exists' => 'Выбранная категория не существует',
            'price.required' => 'Цена товара обязательна',
            'price.numeric' => 'Цена должна быть числом',
            'price.min' => 'Цена не может быть отрицательной',
        ];
    }
}
