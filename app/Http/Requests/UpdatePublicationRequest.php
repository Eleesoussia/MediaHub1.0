<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePublicationRequest extends FormRequest
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
}