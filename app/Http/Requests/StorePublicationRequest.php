<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePublicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titre'        => 'required|string|min:10|max:255',
            'contenu'      => 'required|string|min:20',
            'categorie_id' => 'required|exists:categories,id',
            'image'        => 'nullable|file|image|max:2048',
            'fichier_media'=> 'nullable|file|mimes:mp3,mp4,wav|max:20480',
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required'        => 'Le titre est obligatoire.',
            'titre.min'             => 'Le titre doit faire au moins 10 caractères.',
            'contenu.required'      => 'Le contenu est obligatoire.',
            'contenu.min'           => 'Le contenu doit faire au moins 20 caractères.',
            'categorie_id.required' => 'La catégorie est obligatoire.',
            'categorie_id.exists'   => 'La catégorie sélectionnée n\'existe pas.',
            'image.image'           => 'Le fichier doit être une image.',
            'image.max'             => 'L\'image ne doit pas dépasser 2 Mo.',
            'fichier_media.mimes'   => 'Le fichier média doit être mp3, mp4 ou wav.',
            'fichier_media.max'     => 'Le média ne doit pas dépasser 20 Mo.',
        ];
    }
}