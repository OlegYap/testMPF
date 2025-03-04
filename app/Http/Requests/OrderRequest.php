<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'customer_name' => 'required|string|max:255',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'comment' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'customer_name.required' => 'ФИО покупателя обязательно',
            'product_id.required' => 'Товар должен быть выбран',
            'quantity.required' => 'Количество товара обязательно',
            'quantity.min' => 'Количество должно быть не менее 1',
        ];
    }
}
