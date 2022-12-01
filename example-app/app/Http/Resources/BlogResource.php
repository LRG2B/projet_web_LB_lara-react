<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    public function toArray($request)
    {
        // return parent::toArray($request); //la c'est si on veut vraiment tout avoir
        // On retourne uniquement "body" et "title" si on veut le reste il siffit de l'ajouter juste en dessous 
        return [
            "id" => $this->id,
            "title" => ucfirst($this->title), // La 1er lettre en majuscule
            "body" => $this->body,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }
}
