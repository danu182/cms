<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id'   => 'required',
            'title'         => 'required',
            'slug'          => 'nullable',
            'description'   => 'required',
            'img'           => 'required|image|file|mimes:jpeg,png,jpg,webp|max:2048',
            // 'views'      => 'required|integer',
            'status'        => 'required',
            'publish_date'  => 'required|date',
        ];
    }
}
