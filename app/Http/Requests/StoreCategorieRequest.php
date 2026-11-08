<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategorieRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom'  => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
        ];
    }

    public function messages(): array
    {
        return [
            'nom.required'  => 'Le nom de la catégorie est obligatoire.',
            'nom.max'       => 'Le nom ne doit pas dépasser 255 caractères.',
            'slug.required' => 'Le slug est obligatoire.',
            'slug.unique'   => 'Ce slug existe déjà.',
        ];
    }
}