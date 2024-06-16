<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BibliotecaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'use' => [
                'id' => $this->id,
                'name' => $this->user->name
            ],
            'nome' => 'Nome '.$this->nome,
            'author' => 'Author'.$this->author,
            'isbn' => $this->isbn,
            ];
    }
}
