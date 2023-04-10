<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        // $product = request()->route('product');
        return [
            'name' => [
                'nullable',
                // Rule::unique('products')->ignore($product),
            ],
            'description' => [
                'nullable'
            ],
            'category_id' => [
                'required',
            ],
            'date_available' => [
                'nullable'
            ]
        ];
    }
}
