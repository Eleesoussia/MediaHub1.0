<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategorieRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom'  => 'required|string|max:255',
            'slug' => [
                'required', 'string', 'max:255',
                Rule::unique('categories', 'slug')->ignore($this->categorie),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nom.required'  => 'Le nom est obligatoire.',
            'slug.unique'   => 'Ce slug est déjà utilisé.',
        ];
    }
}