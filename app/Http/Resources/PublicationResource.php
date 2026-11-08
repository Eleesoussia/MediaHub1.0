<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PublicationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'titre'        => $this->titre,
            'contenu'      => $this->contenu,
            'categorie'    => [
                'id'  => $this->categorie?->id,
                'nom' => $this->categorie?->nom,
            ],
            'auteur'       => [
                'id'   => $this->auteur?->id,
                'name' => $this->auteur?->name,
            ],
            'image'        => $this->url_image,
            'fichier_media'=> $this->url_media,
            'type_media'   => $this->type_media,
            'commentaires_count' => $this->whenCounted('commentaires'),
            'publie_le'    => $this->created_at?->format('d/m/Y H:i'),
        ];
    }
}